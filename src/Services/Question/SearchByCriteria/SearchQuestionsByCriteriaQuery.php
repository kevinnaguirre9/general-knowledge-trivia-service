<?php

declare(strict_types=1);

namespace GeneralKnowledgeTrivia\Services\Question\SearchByCriteria;

/**
 * Class SearchQuestionsByCriteriaQuery
 *
 * @package GeneralKnowledgeTrivia\Services\Question\SearchByCriteria
 */
final class SearchQuestionsByCriteriaQuery
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
