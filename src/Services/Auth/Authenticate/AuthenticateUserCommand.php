<?php

namespace GeneralKnowledgeTrivia\Services\Auth\Authenticate;

/**
 * Class AuthenticateUserCommand
 *
 * @package GeneralKnowledgeTrivia\Services\Auth\Authenticate
 */
final class AuthenticateUserCommand
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        private string $email,
        private string $password
    )
    {
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
    public function password(): string
    {
        return $this->password;
    }
}
