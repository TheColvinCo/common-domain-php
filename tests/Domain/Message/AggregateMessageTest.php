<?php declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Message;

use Colvin\CommonDomain\Domain\Model\ValueObject\DateTimeValueObject;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class AggregateMessageTest extends TestCase
{
    public function testCreateAggregateMessageThenCreateAndAssertPayloadCalled(): void
    {
        AggregateMessageStub::init('example', 'v1', 'example');
        $messageId = Uuid::from('1d7f94a5-ef4c-4e21-a67f-8ead66bfaec6');
        $aggregateId = Uuid::from('91cb22cb-e267-4257-b376-5c5ea3a00d95');
        $occurredOn = DateTimeValueObject::from('now');
        $payload = [
            'test' => 'foo'
        ];

        $aggregateMessage = AggregateMessageStub::fromPayload($messageId, $aggregateId, $occurredOn, $payload);

        $expectedSerialization = [
            'messageId' => $messageId->value(),
            'name' => 'example',
            'version' => 'v1',
            'type' => 'example',
            'payload' => [
                'test' => 'foo',
            ],
            'aggregateId' => $aggregateId->value(),
            'occurredOn' => $occurredOn->jsonSerialize(),
        ];

        self::assertEquals($messageId, $aggregateMessage->messageId());
        self::assertEquals($aggregateId, $aggregateMessage->aggregateId());
        self::assertEquals($payload, $aggregateMessage->messagePayload());
        self::assertEquals($expectedSerialization, $aggregateMessage->jsonSerialize());
        self::assertEquals($occurredOn, $aggregateMessage->occurredOn());
        self::assertTrue($aggregateMessage->assertPayloadCalled());
    }
}