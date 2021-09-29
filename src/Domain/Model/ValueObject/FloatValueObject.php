<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Model\ValueObject;

abstract class FloatValueObject implements ValueObject
{
    protected function __construct(private float $value)
    {
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equalTo(self $other): bool
    {
        return static::class === \get_class($other) && $this->value === $other->value;
    }

    final public function jsonSerialize(): float
    {
        return $this->value;
    }

    public static function from(float $value): static
    {
        return new static($value);
    }
}
