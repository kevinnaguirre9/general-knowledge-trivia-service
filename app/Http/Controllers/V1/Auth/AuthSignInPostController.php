<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use GeneralKnowledgeTrivia\Domain\Auth\Exceptions\InvalidAuthCredentials;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidEmail;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidPassword;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserNotFound;
use GeneralKnowledgeTrivia\Services\Auth\Authenticate\AuthenticateUserCommand;
use GeneralKnowledgeTrivia\Services\Auth\Authenticate\UserAuthenticator;
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
     * @param UserAuthenticator $authenticator
     */
    public function __construct(private UserAuthenticator $authenticator)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidEmail
     * @throws InvalidPassword
     * @throws UserNotFound
     * @throws InvalidAuthCredentials
     */
    public function __invoke(Request $request): JsonResponse
    {
        $AuthenticateUserCommand = new AuthenticateUserCommand(
            $request->get('email'),
            $request->get('password'),
        );

        $token = ($this->authenticator)($AuthenticateUserCommand);

        return response()->json([
            'token' => $token,
        ], Response::HTTP_OK);
    }
}
