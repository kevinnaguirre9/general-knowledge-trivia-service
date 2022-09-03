<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use GeneralKnowledgeTrivia\Services\Auth\Deauthenticate\DeauthenticateUserCommand;
use GeneralKnowledgeTrivia\Services\Auth\Deauthenticate\UserDeauthenticator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AuthSignOutDeleteController
 *
 * @package App\Http\Controllers\V1\Auth
 */
final class AuthSignOutDeleteController extends Controller
{
    /**
     * @param UserDeauthenticator $deauthenticator
     */
    public function __construct(private UserDeauthenticator $deauthenticator)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $command = new DeauthenticateUserCommand($request->bearerToken());

        ($this->deauthenticator)($command);

        return response()->json([
            'message' => 'Signed out successfully'
        ], Response::HTTP_OK);
    }
}
