<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AuthSignOutDeleteController
 *
 * @package App\Http\Controllers\V1\Auth
 */
final class AuthSignOutDeleteController extends Controller
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
