<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization;

use Colvin\CommonDomain\Domain\Message\ActionMessage;

interface ActionMessageDeserializer
{
    public function deserialize($message): ActionMessage;
}
