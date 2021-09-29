<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Model\ValueObject;

abstract class StringValueObject implements ValueObject
{
    protected function __construct(private string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equalTo(self $other): bool
    {
        return static::class === \get_class($other) && $this->value === $other->value;
    }

    final public function jsonSerialize(): string
    {
        return $this->value;
    }

    public static function from(string $value): static
    {
        return new static($value);
    }
}
