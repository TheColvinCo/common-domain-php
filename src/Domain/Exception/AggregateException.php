<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Exception;

abstract class AggregateException extends DomainException
{
    abstract public function id(): string;

    abstract public function aggregateType(): string;

    final public function jsonSerialize(): array
    {
        return [
            'id' => $this->id(),
            'aggregateType' => $this->aggregateType(),
        ];
    }
}
