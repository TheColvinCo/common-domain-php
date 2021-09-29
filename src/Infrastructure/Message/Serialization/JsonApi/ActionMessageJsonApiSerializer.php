<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Domain\Message\ActionMessage;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\ActionMessageSerializer;

final class ActionMessageJsonApiSerializer implements ActionMessageSerializer
{
    public function serialize(ActionMessage $message)
    {
        return \json_encode(
            [
                'data' => [
                    'messageId' => $message->messageId(),
                    'type' => $message::messageName(),
                    'attributes' => $message->messagePayload(),
                ],
            ],
            \JSON_THROW_ON_ERROR,
            512,
        );
    }
}
