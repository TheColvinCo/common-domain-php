<?php declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Message;

use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class MessageTest extends TestCase
{
    public function testCreateMessageThenReturnExpectedMethods(): void
    {
        MessageStub::init('example', 'v1', 'example');
        $messageId = Uuid::from('2a113b2a-f352-421a-bb65-b3b8115dbb56');
        $payload = [
            'test' => 'foo',
        ];

        $message = MessageStub::create($messageId, $payload);

        self::assertEquals('example', $message::messageName());
        self::assertEquals('v1', $message::messageVersion());
        self::assertEquals('example', $message::messageType());
        self::assertEquals($messageId, $message->messageId());
        self::assertEquals($payload, $message->messagePayload());
        self::assertTrue($message->assertPayloadCalled());
    }

    public function testGivenNonPrimitivePayloadWhenCreateThenThrowException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        MessageStub::create(
            Uuid::from('17ad92b1-6e0a-400b-b2af-6782dc1a9972'),
            [
                'test' => new \DateTimeImmutable(),
            ],
        );
    }
}