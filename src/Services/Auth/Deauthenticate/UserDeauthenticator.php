<?php

namespace GeneralKnowledgeTrivia\Services\Auth\Deauthenticate;

use GeneralKnowledgeTrivia\Domain\User\User;

/**
 * Class UserDeauthenticator
 *
 * @package GeneralKnowledgeTrivia\Services\Auth\Deauthenticate
 */
final class UserDeauthenticator
{
    /**
     * @param DeauthenticateUserCommand $command
     * @return void
     */
    public function __invoke(DeauthenticateUserCommand $command)
    {
        $User = User::firstWhere('token', '=', $command->getToken());

        $User->token = null;

        $User->save();
    }
}
