<?php

declare(strict_types=1);

namespace GeneralKnowledgeTrivia\Services\User\Find;

/**
 * Class FindUserQuery
 *
 * @package GeneralKnowledgeTrivia\Services\User\Find
 */
final class FindUserQuery
{
    /**
     * @param string $userId
     */
    public function __construct(private string $userId)
    {
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}
