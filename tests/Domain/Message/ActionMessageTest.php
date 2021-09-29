<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Message;

use Colvin\CommonDomain\Domain\Message\ActionMessage;
use Colvin\CommonDomain\Domain\Message\Message;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ActionMessageTest extends TestCase
{
    public function testCreateActionMessageThenCreateAndAssertPayloadCalled(): void
    {
        ActionMessageStub::init('example', 'v1', 'example');
        $messageId = Uuid::from('1d7f94a5-ef4c-4e21-a67f-8ead66bfaec6');
        $payload = [
            'test' => 'foo'
        ];

        $actionMessage = ActionMessageStub::fromPayload($messageId, $payload);

        $expectedSerialization = [
            'messageId' => $messageId->value(),
            'name' => 'example',
            'version' => 'v1',
            'type' => 'example',
            'payload' => [
                'test' => 'foo',
            ],
        ];

        self::assertEquals($messageId, $actionMessage->messageId());
        self::assertEquals($payload, $actionMessage->messagePayload());
        self::assertEquals($expectedSerialization, $actionMessage->jsonSerialize());
        self::assertTrue($actionMessage->assertPayloadCalled());
    }
}
