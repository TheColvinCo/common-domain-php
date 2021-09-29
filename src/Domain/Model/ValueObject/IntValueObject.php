<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Model\ValueObject;

abstract class IntValueObject implements ValueObject
{
    protected function __construct(private int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equalTo(self $other): bool
    {
        return static::class === \get_class($other) && $this->value === $other->value;
    }

    final public function jsonSerialize(): int
    {
        return $this->value;
    }

    public static function from(int $value): static
    {
        return new static($value);
    }
}
