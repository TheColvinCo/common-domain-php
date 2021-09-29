<?php declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Message;

use Colvin\CommonDomain\Domain\Message\Message;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;

final class MessageStub extends Message
{

    private static string $name;
    private static string $version;
    private static string $type;
    private bool $assertPayloadCalled = false;

    public static function init(string $name, string $version, string $type): void
    {
        self::$name = $name;
        self::$version = $version;
        self::$type = $type;
    }

    public static function create(Uuid $uuid, array $payload): self
    {
        return new self($uuid, $payload);
    }

    public static function messageName(): string
    {
        return self::$name;
    }

    public static function messageVersion(): string
    {
        return self::$version;
    }

    public static function messageType(): string
    {
        return self::$type;
    }

    protected function assertPayload(): void
    {
        $this->assertPayloadCalled = true;
    }

    public function assertPayloadCalled(): bool
    {
        return $this->assertPayloadCalled;
    }
}