<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Application;

use Colvin\CommonDomain\Application\Query;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    public function testThatMessageTypeIsQuery(): void
    {
        self::assertEquals('query', Query::messageType());
    }
}