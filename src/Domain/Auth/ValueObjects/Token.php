<?php

namespace GeneralKnowledgeTrivia\Domain\Auth\ValueObjects;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use GeneralKnowledgeTrivia\Domain\Auth\Exceptions\InvalidToken;

/**
 * Class Token
 *
 * @package GeneralKnowledgeTrivia\Domain\Auth\ValueObjects
 */
final class Token
{
    /**
     * @param string|null $value
     */
    public function __construct(public ?string $value = null)
    {
        !$this->value && $this->value = self::generate();
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
    public static function generate(): string
    {
        $today = new \DateTimeImmutable();

        $expireAt = $today->modify('+2 weeks')->getTimestamp();

        $secretKey = getenv('TOKEN_SECRET');

        $payload = [
            'exp' => $expireAt,
        ];

        return JWT::encode($payload, $secretKey, 'HS256');
    }

    /**
     * @return array
     * @throws InvalidToken
     */
    public function decode(): array
    {
        try {

            return (array) JWT::decode($this->value(), new Key(getenv('TOKEN_SECRET'), 'HS256'));

        } catch (\Exception $exception) {

            throw new InvalidToken('Invalid token', previous: $exception);
        }
    }
}
