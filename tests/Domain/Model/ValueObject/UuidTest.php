<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    public function testCreationAndValue(): void
    {
        $uuid = Uuid::from('d4a24129-fe08-48c2-8bbc-37dd03385c0e');
        static::assertEquals('d4a24129-fe08-48c2-8bbc-37dd03385c0e', $uuid->value());
    }

    public function testEqualsMethod(): void
    {
        $uuid = Uuid::from('d4a24129-fe08-48c2-8bbc-37dd03385c0e');
        $uuidEqual = Uuid::from('d4a24129-fe08-48c2-8bbc-37dd03385c0e');
        $uuidNonEqual = Uuid::from('e1274e54-6290-41e3-9d32-97b4df389f18');
        static::assertTrue($uuid->equalTo($uuidEqual));
        static::assertFalse($uuid->equalTo($uuidNonEqual));
    }

    public function testJsonSerialize(): void
    {
        $uuid = Uuid::from('d4a24129-fe08-48c2-8bbc-37dd03385c0e');
        static::assertEquals('d4a24129-fe08-48c2-8bbc-37dd03385c0e', $uuid->jsonSerialize());
    }

    public function testThatInvalidUuidThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Uuid::from('invalid-uuid');
    }
}