<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Domain\Message\AggregateMessage;
use Colvin\CommonDomain\Domain\Model\ValueObject\DateTimeValueObject;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\AggregateMessageDeserializer;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\MessageMappingRegistry;

final class AggregateMessageStreamDeserializer implements AggregateMessageDeserializer
{
    public function __construct(private MessageMappingRegistry $registry)
    {
    }

    public function deserialize($message): AggregateMessage
    {
        if (false === $message instanceof AggregateMessageStream) {
            throw new \LogicException(self::class . ' only works with ' . AggregateMessageStream::class);
        }

        $eventClass = ($this->registry)($message->messageName());

        if (null === $eventClass || false === \class_exists($eventClass)) {
            throw new \RuntimeException(\sprintf('Message %s not found', $message->messageName()));
        }

        return $eventClass::fromPayload(
            Uuid::from($message->messageId()),
            Uuid::from($message->aggregateId()),
            DateTimeValueObject::createFromFormat('U', (string) $message->occurredOn()),
            \json_decode($message->payload(), true, 512, \JSON_THROW_ON_ERROR)
        );
    }
}
