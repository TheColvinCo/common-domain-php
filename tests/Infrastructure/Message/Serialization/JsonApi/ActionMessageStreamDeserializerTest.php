<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi\ActionMessageStream;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi\ActionMessageStreamDeserializer;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\MessageMappingRegistry;
use Colvin\CommonDomain\Tests\Domain\Message\ActionMessageStub;
use PHPUnit\Framework\TestCase;

class ActionMessageStreamDeserializerTest extends TestCase
{
    private ActionMessageStreamDeserializer $deserializer;

    protected function setUp(): void
    {
        ActionMessageStub::init('example', 'v1', 'test');

        $this->deserializer = new ActionMessageStreamDeserializer(
            new MessageMappingRegistry(
                [ActionMessageStub::messageName() => ActionMessageStub::class]
            )
        );
    }

    public function testDeserializeExistActionMessage(): void
    {
        $messageId = 'e73c7f16-7387-4402-b528-3b179ddd7b57';
        $messageName = 'example';
        $messagePayload = [
            'John' => 'Doe',
        ];
        $messageStream = new ActionMessageStream(
            $messageId,
            $messageName,
            \json_encode(
                $messagePayload,
                JSON_THROW_ON_ERROR
            ),
        );

        $message = $this->deserializer->deserialize($messageStream);

        self::assertInstanceOf(ActionMessageStub::class, $message);
        self::assertEquals($messageId, $message->messageId()->value());
        self::assertEquals($messageName, $message::messageName());
        self::assertEquals($messagePayload, $message->messagePayload());
    }

    public function testDeserializeNotFoundActionMessageThenException(): void
    {
        $this->expectException(\RuntimeException::class);

        $messageId = 'e73c7f16-7387-4402-b528-3b179ddd7b57';
        $messageName = 'notFound';
        $messagePayload = [
            'John' => 'Doe',
        ];
        $messageStream = new ActionMessageStream(
            $messageId,
            $messageName,
            \json_encode(
                $messagePayload,
                JSON_THROW_ON_ERROR
            ),
        );

        $this->deserializer->deserialize($messageStream);
    }

    public function testDeserializeActionMessageWithoutStreamThenException(): void
    {
        $this->expectException(\LogicException::class);

        $messagePayload = [
            'John' => 'Doe',
        ];

        $this->deserializer->deserialize($messagePayload);
    }
}
