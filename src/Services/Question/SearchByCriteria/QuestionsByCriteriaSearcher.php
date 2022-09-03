<?php

namespace GeneralKnowledgeTrivia\Services\Question\SearchByCriteria;

use GeneralKnowledgeTrivia\Domain\Question\Question;

/**
 * Class QuestionsByCriteriaSearcher
 *
 * @package GeneralKnowledgeTrivia\Services\Question\SearchByCriteria
 */
final class QuestionsByCriteriaSearcher
{
    /**
     * @param SearchQuestionsByCriteriaQuery $query
     * @return array
     */
    public function __invoke(SearchQuestionsByCriteriaQuery $query): array
    {
        return Question::with('answers')
            ->where('category_id', '=', $query->getCategory())
            ->get()
            ->toArray();
    }
}
