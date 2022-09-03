<?php

namespace GeneralKnowledgeTrivia\Domain\User\ValueObjects;

use GeneralKnowledgeTrivia\Domain\Common\ValueObject;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidPassword;

/**
 * Class Password
 *
 * @package GeneralKnowledgeTrivia\Domain\User\ValueObjects
 */
final class Password extends ValueObject
{
    /**
     * @param string $value
     * @throws InvalidPassword
     */
    public function __construct(private string $value)
    {
        $this->ensureIsValidPassword();
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
     * @throws InvalidPassword
     */
    private function ensureIsValidPassword(): void
    {
        $hasUpperCaseLetters = preg_match('@[A-Z]@', $this->value());

        if(strlen($this->value()) < 8 || !$hasUpperCaseLetters) {

            throw new InvalidPassword(
                'The password should be at least 8 characters in length and include at least one upper case letter'
            );
        }
    }

    /**
     * @param Password $other
     * @return bool
     */
    public function isEquals(Password $other): bool
    {
        return $this->value() === $other->value();
    }
}
