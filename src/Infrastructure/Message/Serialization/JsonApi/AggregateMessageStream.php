<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi;

final class AggregateMessageStream
{
    public function __construct(
        private string $messageId,
        private string $aggregateId,
        private int $occurredOn,
        private string $messageName,
        private string $payload
    ) {
    }

    public function messageId(): string
    {
        return $this->messageId;
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }

    public function messageName(): string
    {
        return $this->messageName;
    }

    public function payload(): string
    {
        return $this->payload;
    }
}
