<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Message;

use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;

abstract class ActionMessage extends Message
{
    final public static function fromPayload(Uuid $messageId, array $payload): static
    {
        return new static($messageId, $payload);
    }
}
