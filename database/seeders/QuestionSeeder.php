<?php

namespace Database\Seeders;

use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\Question\Answer;
use GeneralKnowledgeTrivia\Domain\Question\AnswerId;
use GeneralKnowledgeTrivia\Domain\Question\Question;
use GeneralKnowledgeTrivia\Domain\Question\QuestionId;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

/**
 * Class QuestionSeeder
 *
 * @package Database\Seeders
 */
class QuestionSeeder extends Seeder
{
    private const QUESTIONS = __DIR__ . '/questions.json';

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws InvalidUuid
     */
    public function run()
    {
        $this->addQuestionsToCategories();
    }

    /**
     * @return void
     * @throws InvalidUuid
     */
    public function addQuestionsToCategories() : void
    {
        if(!file_exists(self::QUESTIONS)) {
            Log::info("Questions file not found");
            return;
        }

        $questions = json_decode(
            file_get_contents(self::QUESTIONS),
            true,
        );

        collect($questions)->each(function ($Question) {

            $QuestionCollection = collect($Question);

            $QuestionAttributes = [
                'uuid' => (new QuestionId())->value(),
                ...$QuestionCollection->except(['answers']),
            ];

            $QuestionEntity = Question::create($QuestionAttributes);

            $Answers = collect($QuestionCollection->get('answers'))
                ->map($this->mapAnswers());

            $QuestionEntity
                ->answers()
                ->saveMany($Answers);
        });
    }

    /**
     * @return \Closure
     */
    private function mapAnswers(): \Closure
    {
        return function (array $Answer)
        {
            return new Answer([
                'uuid' => (new AnswerId())->value(),
                ...$Answer,
            ]);
        };
    }
}
