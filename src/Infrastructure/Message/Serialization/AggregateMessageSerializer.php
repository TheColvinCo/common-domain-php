<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization;

use Colvin\CommonDomain\Domain\Message\AggregateMessage;

interface AggregateMessageSerializer
{
    public function serialize(AggregateMessage $message);
}
