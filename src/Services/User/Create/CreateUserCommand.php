<?php

namespace GeneralKnowledgeTrivia\Services\User\Create;

/**
 * Class CreateUserCommand
 *
 * @package GeneralKnowledgeTrivia\Services\User\Create
 */
final class CreateUserCommand
{
    public function __construct(
        private string $firstName,
        private string $surname,
        private string $country,
        private string $email,
        private string $password,
    )
    {
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
