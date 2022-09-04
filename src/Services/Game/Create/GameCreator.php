<?php

namespace GeneralKnowledgeTrivia\Services\Game\Create;

use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\Game\Attempt;
use GeneralKnowledgeTrivia\Domain\Game\Game;
use GeneralKnowledgeTrivia\Domain\Game\Result;
use GeneralKnowledgeTrivia\Domain\Game\ValueObjects\GameId;
use GeneralKnowledgeTrivia\Domain\Question\Exceptions\QuestionNotFound;
use GeneralKnowledgeTrivia\Domain\Question\Question;
use GeneralKnowledgeTrivia\Domain\Question\ValueObjects\AnswerId;
use GeneralKnowledgeTrivia\Domain\Question\ValueObjects\QuestionId;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserNotFound;
use GeneralKnowledgeTrivia\Services\Question\SearchByCriteria\QuestionsByCriteriaSearcher;
use GeneralKnowledgeTrivia\Services\Question\SearchByCriteria\SearchQuestionsByCriteriaQuery;
use GeneralKnowledgeTrivia\Services\User\Find\FindUserQuery;
use GeneralKnowledgeTrivia\Services\User\Find\UserFinder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GameCreator
 *
 * @package GeneralKnowledgeTrivia\Services\Game\Create
 */
final class GameCreator
{
    /**
     * @param UserFinder $userFinder
     * @param QuestionsByCriteriaSearcher $questionsSearcher
     */
    public function __construct(
        private UserFinder $userFinder,
        private QuestionsByCriteriaSearcher $questionsSearcher,
    )
    {
    }

    /**
     * @param CreateGameCommand $command
     * @return void
     * @throws CategoryNotFound
     * @throws InvalidUuid
     * @throws UserNotFound
     */
    public function __invoke(CreateGameCommand $command)
    {
        $questions = ($this->questionsSearcher)(
            new SearchQuestionsByCriteriaQuery($command->getCategoryId())
        );

        $this->ensureUserExists(
            new FindUserQuery($command->getUserId())
        );

        $attempts = collect($command->getAttempts())
            ->map($this->createAttempt($questions));

        $Result = Result::fromAttempts($attempts, $command->getTimePlayed());

        /** @var Game $Game */
        $Game = Game::create([
            'uuid'          => (new GameId())->value(),
            'user_id'       => $command->getUserId(),
            'category_id'   => $command->getCategoryId(),
            'time_played'   => $command->getTimePlayed(),
        ]);

        $Game->attempts()
            ->saveMany($attempts);

        $Game->result()
            ->save($Result);
    }

    /**
     * @param FindUserQuery $query
     * @return void
     * @throws InvalidUuid
     * @throws UserNotFound
     */
    private function ensureUserExists(FindUserQuery $query): void
    {
        $User = ($this->userFinder)($query);

        if (null === $User)
            throw new UserNotFound('User with given identifier not found');
    }

    /**
     * @param Collection $questions
     * @return \Closure
     */
    private function createAttempt(Collection $questions): \Closure
    {
        return function (array $attempt) use ($questions) {

            $QuestionId = new QuestionId(data_get($attempt, 'question_id'));

            $Question = $questions->firstWhere(
                'uuid', '=', $QuestionId->value()
            );

            $this->ensureQuestionExists($Question, $QuestionId);

            $userAnswerId = (new AnswerId(data_get($attempt, 'answer_id')));

            $isRightAnswer = $Question->getCorrectAnswer()->uuid === $userAnswerId->value();

            return new Attempt([
                'question_id'       => $Question->uuid,
                'answer_id'         => $userAnswerId->value(),
                'is_right_answer'   => $isRightAnswer
            ]);
        };
    }

    /**
     * @param Question|null $Question
     * @param QuestionId $QuestionId
     * @return void
     * @throws QuestionNotFound
     */
    private function ensureQuestionExists(?Question $Question, QuestionId $QuestionId)
    {
        if(null === $Question)
            throw new QuestionNotFound("Question with <{$QuestionId}> identifier not found");
    }
}
