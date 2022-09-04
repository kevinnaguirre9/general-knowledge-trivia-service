<?php

namespace App\Http\Controllers\V1\Category;

use App\Http\Controllers\Controller;
use GeneralKnowledgeTrivia\Services\Category\SearchAll\AllCategoriesSearcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class CategoryGetAllController
 *
 * @package App\Http\Controllers\V1\Category
 */
final class CategoryGetAllController extends Controller
{
    /**
     * @param AllCategoriesSearcher $searcher
     */
    public function __construct(private AllCategoriesSearcher $searcher)
    {
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $categories = ($this->searcher)();

        return response()->json($categories, Response::HTTP_OK);
    }
}
