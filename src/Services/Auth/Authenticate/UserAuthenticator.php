<?php

namespace GeneralKnowledgeTrivia\Services\Auth\Authenticate;

use GeneralKnowledgeTrivia\Domain\Auth\Exceptions\InvalidAuthCredentials;
use GeneralKnowledgeTrivia\Domain\Auth\ValueObjects\Token;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidEmail;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidPassword;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserNotFound;
use GeneralKnowledgeTrivia\Domain\User\User;
use GeneralKnowledgeTrivia\Domain\User\ValueObjects\Email;
use GeneralKnowledgeTrivia\Domain\User\ValueObjects\Password;
use GeneralKnowledgeTrivia\Services\User\Find\UserByEmailFinder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserAuthenticator
 *
 * @package GeneralKnowledgeTrivia\Services\Auth
 */
final class UserAuthenticator
{
    /**
     * @param UserByEmailFinder $finder
     */
    public function __construct(private UserByEmailFinder $finder)
    {
    }

    /**
     * @param AuthenticateUserCommand $command
     * @return string
     * @throws InvalidEmail
     * @throws UserNotFound
     * @throws InvalidPassword
     * @throws InvalidAuthCredentials
     */
    public function __invoke(AuthenticateUserCommand $command) : string
    {
        $User = ($this->finder)(new Email($command->getEmail()));

        $this->ensureUserExists($User);

        $this->ensurePasswordsMatches($User, new Password($command->password()));

        $token = (new Token())->value();

        $User->update(['token' => $token]);

        return $token;
    }

    /**
     * @param User|null $User
     * @return void
     * @throws UserNotFound
     */
    private function ensureUserExists(?User $User): void
    {
        if (null === $User)
            throw new UserNotFound('User with given email not found');
    }

    /**
     * @param User $User
     * @param Password $password
     * @return void
     * @throws InvalidAuthCredentials
     */
    private function ensurePasswordsMatches(User $User, Password $password): void
    {
        if(!Hash::check($password->value(), $User->getAuthPassword()))
            throw new InvalidAuthCredentials("Wrong password");

    }
}
