<?php

declare(strict_types=1);

namespace GeneralKnowledgeTrivia\Services\Game\Create;

/**
 * Class CreateGameCommand
 *
 * @package GeneralKnowledgeTrivia\Services\Game\Create
 */
final class CreateGameCommand
{
    /**
     * @param string $userId
     * @param string $categoryId
     * @param float $timePlayed
     */
    public function __construct(
        private string $userId,
        private string $categoryId,
        private float $timePlayed,
    )
    {
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @return float
     */
    public function getTimePlayed(): float
    {
        return $this->timePlayed;
    }
}
