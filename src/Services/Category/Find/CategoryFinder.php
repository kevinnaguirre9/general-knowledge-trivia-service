<?php

namespace GeneralKnowledgeTrivia\Services\Category\Find;

use GeneralKnowledgeTrivia\Domain\Category\Category;
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
     */
    public function __invoke(FindCategoryQuery $query): ?Category
    {
        $CategoryId = new CategoryId($query->getCategoryId());

        return Category::firstWhere(
            'uuid', '=', $CategoryId->value()
        );
    }
}
