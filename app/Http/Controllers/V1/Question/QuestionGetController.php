<?php

namespace App\Http\Controllers\V1\Question;

use App\Http\Controllers\Controller;
use GeneralKnowledgeTrivia\Services\Question\SearchByCriteria\QuestionsByCriteriaSearcher;
use GeneralKnowledgeTrivia\Services\Question\SearchByCriteria\SearchQuestionsByCriteriaQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class QuestionGetController
 *
 * @package App\Http\Controllers\V1\Question
 */
final class QuestionGetController extends Controller
{
    public function __construct(private QuestionsByCriteriaSearcher $searcher)
    {
    }

    public function __invoke(string $category): JsonResponse
    {
        $Query = new SearchQuestionsByCriteriaQuery($category);

        $questions = ($this->searcher)($Query);

        return response()->json($questions, Response::HTTP_OK);
    }
}
