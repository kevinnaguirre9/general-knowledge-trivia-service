<?php

namespace GeneralKnowledgeTrivia\Domain\User\ValueObjects;

use GeneralKnowledgeTrivia\Domain\Common\ValueObject;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidEmail;

/**
 * Class Email
 *
 * @package GeneralKnowledgeTrivia\Domain\User\ValueObjects
 */
final class Email extends ValueObject
{
    /**
     * @param string $value
     * @throws InvalidEmail
     */
    public function __construct(private string $value)
    {
        $this->ensureIsValidEmail();
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return void
     * @throws InvalidEmail
     */
    private function ensureIsValidEmail(): void
    {
        if (!filter_var($this->value(), FILTER_VALIDATE_EMAIL))
            throw new InvalidEmail('Invalid email');
    }

    /**
     * @param Email $email
     * @return bool
     */
    public function isEquals(Email $email): bool
    {
        return $this->value() === $email->value();
    }
}
