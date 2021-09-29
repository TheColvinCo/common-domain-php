<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain;

use Colvin\CommonDomain\Domain\Message\AggregateMessage;

abstract class DomainEvent extends AggregateMessage
{
    public static function messageType(): string
    {
        return 'domain_event';
    }
}
