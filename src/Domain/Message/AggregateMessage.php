<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Message;

use Colvin\CommonDomain\Domain\Model\ValueObject\DateTimeValueObject;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;

abstract class AggregateMessage extends Message
{
    final protected function __construct(
        Uuid $messageId,
        private Uuid $aggregateId,
        private DateTimeValueObject $occurredOn,
        array $payload
    ) {
        parent::__construct($messageId, $payload);
    }

    final public static function fromPayload(
        Uuid $messageId,
        Uuid $aggregateId,
        DateTimeValueObject $occurredOn,
        array $payload
    ): static {
        return new static($messageId, $aggregateId, $occurredOn, $payload);
    }

    public function aggregateId(): Uuid
    {
        return $this->aggregateId;
    }

    final public function jsonSerialize(): array
    {
        return \array_merge(
            parent::jsonSerialize(),
            [
                'aggregateId' => $this->aggregateId->value(),
                'occurredOn' => $this->occurredOn->jsonSerialize(),
            ],
        );
    }

    public function occurredOn(): DateTimeValueObject
    {
        return $this->occurredOn;
    }
}
