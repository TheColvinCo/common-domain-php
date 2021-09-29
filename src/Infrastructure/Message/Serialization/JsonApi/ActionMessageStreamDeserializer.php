<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Domain\Message\ActionMessage;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\ActionMessageDeserializer;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\MessageMappingRegistry;

final class ActionMessageStreamDeserializer implements ActionMessageDeserializer
{
    public function __construct(private MessageMappingRegistry $registry)
    {
    }

    public function deserialize($message): ActionMessage
    {
        if (false === $message instanceof ActionMessageStream) {
            throw new \LogicException(self::class . ' only works with ' . ActionMessageStream::class);
        }

        $messageClass = ($this->registry)($message->messageName());

        if (null === $messageClass || false === \class_exists($messageClass)) {
            throw new \RuntimeException(\sprintf('Message %s not found', $message->messageName()));
        }

        return $messageClass::fromPayload(
            Uuid::from($message->messageId()),
            \json_decode(
                $message->payload(),
                true,
                512,
                \JSON_THROW_ON_ERROR,
            ),
        );
    }
}
