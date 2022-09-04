<?php

namespace GeneralKnowledgeTrivia\Services\User\Find;

use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\User\User;
use GeneralKnowledgeTrivia\Domain\User\ValueObjects\UserId;

/**
 * Class UserFinder
 *
 * @package GeneralKnowledgeTrivia\Services\User\Find
 */
final class UserFinder
{
    /**
     * @param FindUserQuery $query
     * @return User|null
     * @throws InvalidUuid
     */
    public function __invoke(FindUserQuery $query): ?User
    {
        $UserId = new UserId($query->getUserId());

        return User::firstWhere(
            'uuid', '=', $UserId->value()
        );
    }
}
