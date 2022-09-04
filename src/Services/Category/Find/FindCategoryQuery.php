<?php

namespace GeneralKnowledgeTrivia\Services\Category\Find;

/**
 * Class FindCategoryQuery
 *
 * @package GeneralKnowledgeTrivia\Services\Category\Find
 */
final class FindCategoryQuery
{
    /**
     * @param string $categoryId
     */
    public function __construct(private string $categoryId)
    {
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
}
