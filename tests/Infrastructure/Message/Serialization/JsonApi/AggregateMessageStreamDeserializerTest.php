<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi\AggregateMessageStream;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi\AggregateMessageStreamDeserializer;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\MessageMappingRegistry;
use Colvin\CommonDomain\Tests\Domain\Message\AggregateMessageStub;
use PHPUnit\Framework\TestCase;

class AggregateMessageStreamDeserializerTest extends TestCase
{
    private AggregateMessageStreamDeserializer $deserializer;

    protected function setUp(): void
    {
        AggregateMessageStub::init('example', 'v1', 'test');

        $this->deserializer = new AggregateMessageStreamDeserializer(
            new MessageMappingRegistry(
                [AggregateMessageStub::messageName() => AggregateMessageStub::class]
            )
        );
    }

    public function testDeserializeExistAggregateMessage(): void
    {
        $messageId = 'e73c7f16-7387-4402-b528-3b179ddd7b57';
        $aggregateId = '3af67c7f-c8f2-4331-8cad-d74e6567a2ce';
        $occurredOn = 1631942447;
        $messageName = 'example';
        $messagePayload = [
            'John' => 'Doe',
        ];

        $messageStream = new AggregateMessageStream(
            $messageId,
            $aggregateId,
            $occurredOn,
            $messageName,
            \json_encode(
                $messagePayload,
                JSON_THROW_ON_ERROR
            ),
        );

        $message = $this->deserializer->deserialize($messageStream);

        self::assertInstanceOf(AggregateMessageStub::class, $message);
        self::assertEquals($messageId, $message->messageId()->value());
        self::assertEquals($messageName, $message::messageName());
        self::assertEquals($messagePayload, $message->messagePayload());
        self::assertEquals($aggregateId, $message->aggregateId());
        self::assertEquals($occurredOn, $message->occurredOn()->getTimestamp());
    }

    public function testDeserializeNotFoundAggregateMessageThenException(): void
    {
        $this->expectException(\RuntimeException::class);

        $messageId = 'e73c7f16-7387-4402-b528-3b179ddd7b57';
        $aggregateId = '3af67c7f-c8f2-4331-8cad-d74e6567a2ce';
        $occurredOn = 1631942447;
        $messageName = 'not-found';
        $messagePayload = [
            'John' => 'Doe',
        ];

        $messageStream = new AggregateMessageStream(
            $messageId,
            $aggregateId,
            $occurredOn,
            $messageName,
            \json_encode(
                $messagePayload,
                JSON_THROW_ON_ERROR
            ),
        );

        $this->deserializer->deserialize($messageStream);
    }

    public function testDeserializeAggregateMessageWithoutStreamThenException(): void
    {
        $this->expectException(\LogicException::class);

        $messagePayload = [
            'John' => 'Doe',
        ];

        $this->deserializer->deserialize($messagePayload);
    }
}
