<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AuthSignInPostController
 *
 * @package App\Http\Controllers\V1\Auth
 */
final class AuthSignInPostController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()
            ->json([], Response::HTTP_CREATED);
    }
}
