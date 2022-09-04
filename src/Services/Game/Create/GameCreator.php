<?php

namespace GeneralKnowledgeTrivia\Services\Game\Create;

use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Category\ValueObjects\CategoryId;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\Game\Game;
use GeneralKnowledgeTrivia\Domain\Game\ValueObjects\GameId;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserNotFound;
use GeneralKnowledgeTrivia\Services\Category\Find\CategoryFinder;
use GeneralKnowledgeTrivia\Services\Category\Find\FindCategoryQuery;
use GeneralKnowledgeTrivia\Services\User\Find\FindUserQuery;
use GeneralKnowledgeTrivia\Services\User\Find\UserFinder;

/**
 * Class GameCreator
 *
 * @package GeneralKnowledgeTrivia\Services\Game\Create
 */
final class GameCreator
{
    /**
     * @param CategoryFinder $categoryFinder
     * @param UserFinder $userFinder
     */
    public function __construct(
        private CategoryFinder $categoryFinder,
        private UserFinder $userFinder,
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
        $this->ensureCategoryExists(
            new FindCategoryQuery($command->getCategoryId())
        );

        $this->ensureUserExists(
            new FindUserQuery($command->getUserId())
        );

        Game::create([
            'uuid'          => (new GameId())->value(),
            'user_id'       => $command->getUserId(),
            'category_id'   => $command->getCategoryId(),
            'time_played'   => $command->getTimePlayed(),
        ]);
    }

    /**
     * @param FindCategoryQuery $query
     * @return void
     * @throws CategoryNotFound
     * @throws InvalidUuid
     */
    private function ensureCategoryExists(FindCategoryQuery $query): void
    {
        $Category = ($this->categoryFinder)($query);

        if (null === $Category)
            throw new CategoryNotFound('Category with given identifier not found');
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
}
