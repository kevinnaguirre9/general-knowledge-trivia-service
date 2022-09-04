<?php

namespace App\Http\Controllers\V1\Game;

use App\Http\Controllers\Controller;
use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserNotFound;
use GeneralKnowledgeTrivia\Services\Game\Create\CreateGameCommand;
use GeneralKnowledgeTrivia\Services\Game\Create\GameCreator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class GamePostController
 *
 * @package App\Http\Controllers\V1\Game
 */
final class GamePostController extends Controller
{
    /**
     * @param GameCreator $creator
     */
    public function __construct(private GameCreator $creator)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws CategoryNotFound
     * @throws InvalidUuid
     * @throws UserNotFound
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, $this->getRequestRules());

        $command = new CreateGameCommand(
            auth()->user()->uuid,
            $request->get('category_id'),
            $request->get('time_played'),
        );

        ($this->creator)($command);

        return response()->json([
            'message' => 'Game information stored successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * @return array
     */
    private function getRequestRules(): array
    {
        return [
            'category_id'   => 'required|string',
            'time_played'   => 'required|numeric',
        ];
    }
}
