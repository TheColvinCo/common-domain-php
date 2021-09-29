<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi;

final class ActionMessageStream
{
    public function __construct(
        private string $messageId,
        private string $messageName,
        private string $payload
    ) {
    }

    public function messageId(): string
    {
        return $this->messageId;
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
