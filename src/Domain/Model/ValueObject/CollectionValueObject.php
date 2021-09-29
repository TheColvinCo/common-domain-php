<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Model\ValueObject;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class CollectionValueObject implements Countable, IteratorAggregate
{
    protected function __construct(private array $items)
    {
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    abstract protected function type(): string;

    protected function items(): array
    {
        return $this->items;
    }
}
