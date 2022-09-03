<?php

namespace GeneralKnowledgeTrivia\Services\Auth\Deauthenticate;

/**
 * Class DeauthenticateUserCommand
 *
 * @package GeneralKnowledgeTrivia\Services\Auth\Deauthenticate
 */
final class DeauthenticateUserCommand
{
    /**
     * @param string $token
     */
    public function __construct(private string $token)
    {
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
