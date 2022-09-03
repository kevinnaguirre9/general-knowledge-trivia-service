<?php

namespace GeneralKnowledgeTrivia\Services\User\Find;

use GeneralKnowledgeTrivia\Domain\User\User;
use GeneralKnowledgeTrivia\Domain\User\ValueObjects\Email;

/**
 * Class UserByEmailFinder
 *
 * @package GeneralKnowledgeTrivia\Services\User\Find
 */
final class UserByEmailFinder
{
    /**
     * @param Email $email
     * @return mixed
     */
    public function __invoke(Email $email): mixed
    {
        return User::firstWhere('email', '=', $email->value());
    }
}
