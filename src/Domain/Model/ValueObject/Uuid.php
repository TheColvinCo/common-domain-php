<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Model\ValueObject;

class Uuid extends StringValueObject
{
    public static function from(string $value): static
    {
        return new static(\Symfony\Component\Uid\Uuid::fromString($value)->jsonSerialize());
    }

    public static function v4(): static
    {
        return new static(\Symfony\Component\Uid\Uuid::v4()->jsonSerialize());
    }
}
