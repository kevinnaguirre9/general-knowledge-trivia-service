<?php

namespace GeneralKnowledgeTrivia\Services\User\Create;

use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidEmail;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserAlreadyRegistered;
use GeneralKnowledgeTrivia\Domain\User\User;
use GeneralKnowledgeTrivia\Domain\User\ValueObjects\Email;
use GeneralKnowledgeTrivia\Domain\User\ValueObjects\Password;
use GeneralKnowledgeTrivia\Domain\User\ValueObjects\UserId;
use GeneralKnowledgeTrivia\Services\User\Find\UserByEmailFinder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCreator
 *
 * @package GeneralKnowledgeTrivia\Services\User\Create
 */
final class UserCreator
{
    public function __construct(private UserByEmailFinder $finder)
    {
    }

    /**
     * @param CreateUserCommand $command
     * @return void
     * @throws InvalidEmail
     * @throws \Exception
     */
    public function __invoke(CreateUserCommand $command) : void
    {
        $email = new Email($command->getEmail());

        $password = Hash::make(
            (new Password($command->getPassword()))->value()
        );

        $this->ensureUserDoesNotExist($email);

        User::create([
            'uuid'          => (new UserId())->value(),
            'first_name'    => $command->getFirstName(),
            'surname'       => $command->getSurname(),
            'country'       => $command->getCountry(),
            'email'         => $email->value(),
            'password'      => $password,
        ]);
    }

    /**
     * @param Email $email
     * @return void
     * @throws UserAlreadyRegistered
     */
    private function ensureUserDoesNotExist(Email $email): void
    {
        $User = ($this->finder)($email);

        if($User)
            throw new UserAlreadyRegistered("User with given email already registered");
    }
}
