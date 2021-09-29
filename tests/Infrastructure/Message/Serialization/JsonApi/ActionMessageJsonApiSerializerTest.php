<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi\ActionMessageJsonApiSerializer;
use Colvin\CommonDomain\Tests\Domain\Message\ActionMessageStub;
use PHPUnit\Framework\TestCase;

class ActionMessageJsonApiSerializerTest extends TestCase
{
    public function testSerializeActionMessage(): void
    {
        ActionMessageStub::init('example', '1', 'example');
        $actionMessage = ActionMessageStub::fromPayload(
            Uuid::from('80f0f97a-2c84-4eb3-845c-de4997a843f5'),
            [
                'foo' => 'bar',
                'baz' => 'test',
            ]
        );

        $expected = [
            'data' => [
                'messageId' => '80f0f97a-2c84-4eb3-845c-de4997a843f5',
                'type' => 'example',
                'attributes' => [
                    'foo' => 'bar',
                    'baz' => 'test',
                ]
            ]
        ];

        $serializer = new ActionMessageJsonApiSerializer();

        self::assertEquals(\json_encode($expected, JSON_THROW_ON_ERROR), $serializer->serialize($actionMessage));
    }
}
