<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Domain\Message\AggregateMessage;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\AggregateMessageSerializer;

final class AggregateMessageJsonApiSerializer implements AggregateMessageSerializer
{
    public function serialize(AggregateMessage $message)
    {
        return \json_encode(
            [
                'data' => [
                    'messageId' => $message->messageId(),
                    'type' => $message::messageName(),
                    'occurredOn' => $message->occurredOn()->getTimestamp(),
                    'attributes' => \array_merge(
                        ['aggregateId' => $message->aggregateId()->value()],
                        $message->messagePayload(),
                    ),
                ],
            ],
            \JSON_THROW_ON_ERROR,
            512,
        );
    }
}
