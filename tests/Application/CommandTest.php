<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Application;

use Colvin\CommonDomain\Application\Command;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testThatMessageTypeIsCommand(): void
    {
        self::assertEquals('command', Command::messageType());
    }
}