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
     * @param string $category
     */
    public function __construct(private string $category)
    {
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}
