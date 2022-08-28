<?php

namespace GeneralKnowledgeTrivia\Domain\Common\ValueObjects;

use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\Common\ValueObject;
use Ramsey\Uuid\Uuid;

/**
 * Class RamseyUuid
 *
 * @package GeneralKnowledgeTrivia\Domain\Common\ValueObjects
 */
class RamseyUuid extends ValueObject
{
    /**
     * @var string
     */
    private string $value;

    /**
     * @param string|null $value
     * @throws InvalidUuid
     */
    public function __construct(?string $value = null)
    {
        $this->value = $value
            ? $this->ensureIsValidUuid($value)
            : self::generateUuid4();
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    private static function generateUuid4(): string
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * @throws InvalidUuid
     */
    private function ensureIsValidUuid(string $uuid): string
    {
        if (!Uuid::isValid($uuid))
            throw new InvalidUuid(sprintf('Invalid uuid <%s>.', $uuid));

        return $uuid;
    }

    /**
     * @param RamseyUuid $other
     * @return bool
     */
    public function equals(RamseyUuid $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
