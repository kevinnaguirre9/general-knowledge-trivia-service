<?php

namespace GeneralKnowledgeTrivia\Services\Game\SearchByCriteria;

use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\Game\Game;
use GeneralKnowledgeTrivia\Services\Category\Find\CategoryFinder;
use GeneralKnowledgeTrivia\Services\Category\Find\FindCategoryQuery;

/**
 * Class GamesByCriteriaSearcher
 *
 * @package GeneralKnowledgeTrivia\Services\Game\SearchByCriteria
 */
final class GamesByCriteriaSearcher
{
    /**
     * @param CategoryFinder $categoryFinder
     */
    public function __construct(private CategoryFinder $categoryFinder)
    {
    }

    /**
     * @param SearchGamesByCriteriaQuery $query
     * @return mixed
     * @throws CategoryNotFound
     * @throws InvalidUuid
     */
    public function __invoke(SearchGamesByCriteriaQuery $query): mixed
    {
        $Category = ($this->categoryFinder)(
            new FindCategoryQuery($query->getCategoryId())
        );

        return Game::where('category_id', '=', $Category->getUuid())
            ->paginate();
    }
}
