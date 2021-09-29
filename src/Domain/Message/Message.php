<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Message;

use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;

abstract class Message implements \JsonSerializable
{
    protected function __construct(private Uuid $messageId, private array $payload)
    {
        $this->assertPrimitivePayload($this->payload);
        $this->assertPayload();
    }

    abstract public static function messageName(): string;

    abstract public static function messageVersion(): string;

    abstract public static function messageType(): string;

    public function messageId(): Uuid
    {
        return $this->messageId;
    }

    public function messagePayload(): array
    {
        return $this->payload;
    }

    public function jsonSerialize(): array
    {
        return [
            'messageId' => $this->messageId()->value(),
            'name' => static::messageName(),
            'version' => static::messageVersion(),
            'type' => static::messageType(),
            'payload' => $this->messagePayload(),
        ];
    }

    abstract protected function assertPayload(): void;

    private function assertPrimitivePayload(array &$payload, string $index = 'payload'): void
    {
        \array_walk(
            $payload,
            function ($item, $currentIndex) use ($index) {
                $newIndex = "{$index}.{$currentIndex}";

                if (true === \is_object($item)) {
                    throw new \InvalidArgumentException(
                        \sprintf(
                            'Attribute %s is an object. Payload parameters only can be primitive.',
                            $newIndex,
                        ),
                    );
                }

                if (true !== \is_array($item)) {
                    return;
                }

                $this->assertPrimitivePayload($item, $newIndex);
            },
        );
    }
}
