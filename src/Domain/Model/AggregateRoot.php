<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Model;

use Colvin\CommonDomain\Domain\DomainEvent;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;

abstract class AggregateRoot
{
    private array $domainEvents = [];

    final protected function __construct(private Uuid $aggregateId)
    {
    }

    abstract public static function modelName(): string;

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final public function aggregateId(): Uuid
    {
        return $this->aggregateId;
    }

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
