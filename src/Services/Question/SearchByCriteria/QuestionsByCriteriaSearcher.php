<?php

namespace GeneralKnowledgeTrivia\Services\Question\SearchByCriteria;

use GeneralKnowledgeTrivia\Domain\Category\Category;
use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\Question\Question;
use GeneralKnowledgeTrivia\Services\Category\Find\CategoryFinder;
use GeneralKnowledgeTrivia\Services\Category\Find\FindCategoryQuery;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class QuestionsByCriteriaSearcher
 *
 * @package GeneralKnowledgeTrivia\Services\Question\SearchByCriteria
 */
final class QuestionsByCriteriaSearcher
{
    /**
     * @param CategoryFinder $categoryFinder
     */
    public function __construct(private CategoryFinder $categoryFinder)
    {
    }

    /**
     * @param SearchQuestionsByCriteriaQuery $query
     * @return Collection
     * @throws CategoryNotFound
     * @throws InvalidUuid
     */
    public function __invoke(SearchQuestionsByCriteriaQuery $query): Collection
    {
        $Category = ($this->categoryFinder)(
            new FindCategoryQuery($query->getCategory())
        );

        $this->ensureCategoryExists($Category);

        return $Category
            ->questions()
            ->get();
    }

    /**
     * @param Category|null $Category
     * @return void
     * @throws CategoryNotFound
     */
    private function ensureCategoryExists(?Category $Category): void
    {
        if(null === $Category)
            throw new CategoryNotFound('Category with given identifier not found');
    }
}
