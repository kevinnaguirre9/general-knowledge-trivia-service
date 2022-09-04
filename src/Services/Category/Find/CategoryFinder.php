<?php

namespace GeneralKnowledgeTrivia\Services\Category\Find;

use GeneralKnowledgeTrivia\Domain\Category\Category;
use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Category\ValueObjects\CategoryId;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;

/**
 * Class CategoryFinder
 *
 * @package GeneralKnowledgeTrivia\Services\Category\Find
 */
final class CategoryFinder
{
    /**
     * @param FindCategoryQuery $query
     * @return Category|null
     * @throws InvalidUuid
     * @throws CategoryNotFound
     */
    public function __invoke(FindCategoryQuery $query): ?Category
    {
        $CategoryId = new CategoryId($query->getCategoryId());

        $Category = Category::firstWhere(
            'uuid', '=', $CategoryId->value()
        );

        $this->ensureCategoryExists($Category);

        return $Category;
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
