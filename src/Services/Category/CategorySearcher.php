<?php

namespace GeneralKnowledgeTrivia\Services\Category;

use GeneralKnowledgeTrivia\Domain\Category\Category;

/**
 * Class CategorySearcher
 *
 * @package GeneralKnowledgeTrivia\Services\Category
 */
final class CategorySearcher
{
    /**
     * @return array
     */
    public function __invoke() : array
    {
        return Category::all()->toArray();
    }
}
