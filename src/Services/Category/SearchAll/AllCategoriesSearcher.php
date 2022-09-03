<?php

namespace GeneralKnowledgeTrivia\Services\Category\SearchAll;

use GeneralKnowledgeTrivia\Domain\Category\Category;

/**
 * Class AllCategoriesSearcher
 *
 * @package GeneralKnowledgeTrivia\Services\Category\SearchAll
 */
final class AllCategoriesSearcher
{
    /**
     * @return array
     */
    public function __invoke() : array
    {
        return Category::all()->toArray();
    }
}
