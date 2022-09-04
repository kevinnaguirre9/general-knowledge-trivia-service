<?php

namespace App\Http\Controllers\V1\Game;

use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Services\Game\SearchByCriteria\GamesByCriteriaSearcher;
use GeneralKnowledgeTrivia\Services\Game\SearchByCriteria\SearchGamesByCriteriaQuery;
use Illuminate\Http\Response;

/**
 * Class GamesByCriteriaGetController
 *
 * @package App\Http\Controllers\V1\Game
 */
final class GamesByCriteriaGetController
{
    /**
     * @param GamesByCriteriaSearcher $searcher
     */
    public function __construct(private GamesByCriteriaSearcher $searcher)
    {
    }

    /**
     * @param string $category
     * @return Response
     * @throws CategoryNotFound
     * @throws InvalidUuid
     */
    public function __invoke(string $category): Response
    {
        $games = ($this->searcher)(
            new SearchGamesByCriteriaQuery($category)
        );

        return new Response(
            json_encode($games, JSON_UNESCAPED_SLASHES),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
