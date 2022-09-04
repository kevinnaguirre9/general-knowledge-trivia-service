<?php

namespace GeneralKnowledgeTrivia\Services\Game\SearchByCriteria;

/**
 * Class SearchGamesByCriteriaQuery
 *
 * @package GeneralKnowledgeTrivia\Services\Game\SearchByCriteria
 */
final class SearchGamesByCriteriaQuery
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
