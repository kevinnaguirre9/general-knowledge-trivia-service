<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidEmail;
use GeneralKnowledgeTrivia\Services\User\Create\CreateUserCommand;
use GeneralKnowledgeTrivia\Services\User\Create\UserCreator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthSignUpPostController
 *
 * @package App\Http\Controllers\V1\Auth
 */
final class AuthSignUpPostController extends Controller
{
    /**
     * @param UserCreator $creator
     */
    public function __construct(private UserCreator $creator)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws InvalidEmail
     *
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->getRequestRules());

        $CreateUserCommand = new CreateUserCommand(
            $request->get('first_name'),
            $request->get('surname'),
            $request->get('country'),
            $request->get('email'),
            $request->get('password'),
        );

        ($this->creator)($CreateUserCommand);

        return response()->json([
            'message' => 'User created successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * @return string[]
     */
    private function getRequestRules(): array
    {
        return [
            'first_name'    => 'required|string',
            'surname'       => 'required|string',
            'country'       => 'required|string',
            'email'         => 'required|email:rfc',
            'password'      => 'required|string',
        ];
    }
}
