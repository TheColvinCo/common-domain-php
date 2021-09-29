<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Application;

use Colvin\CommonDomain\Domain\Message\ActionMessage;

abstract class Command extends ActionMessage
{
    public static function messageType(): string
    {
        return 'command';
    }
}
