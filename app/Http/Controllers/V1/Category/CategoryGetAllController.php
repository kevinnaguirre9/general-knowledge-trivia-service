<?php

namespace App\Http\Controllers\V1\Category;

use App\Http\Controllers\Controller;
use GeneralKnowledgeTrivia\Services\Category\CategorySearcher;
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
     * @param CategorySearcher $searcher
     */
    public function __construct(private CategorySearcher $searcher)
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
