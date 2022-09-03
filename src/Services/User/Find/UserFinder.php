<?php

namespace GeneralKnowledgeTrivia\Services\User\Find;

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
     * @param UserId $userId
     * @return mixed
     */
    public function __invoke(UserId $userId): mixed
    {
        return User::firstWhere(
            'uuid', '=', $userId->value()
        )->get();
    }
}
