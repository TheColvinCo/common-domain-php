<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Infrastructure\Message\Serialization\JsonApi;

use Colvin\CommonDomain\Domain\Model\ValueObject\DateTimeValueObject;
use Colvin\CommonDomain\Domain\Model\ValueObject\Uuid;
use Colvin\CommonDomain\Infrastructure\Message\Serialization\JsonApi\AggregateMessageJsonApiSerializer;
use Colvin\CommonDomain\Tests\Domain\Message\AggregateMessageStub;
use PHPUnit\Framework\TestCase;

class AggregateMessageJsonApiSerializerTest extends TestCase
{
    public function testSerializeAggregateMessage(): void
    {
        AggregateMessageStub::init('example', '1', 'example');
        $aggregateMessage = AggregateMessageStub::fromPayload(
            Uuid::from('80f0f97a-2c84-4eb3-845c-de4997a843f5'),
            Uuid::from('681db695-2094-490d-85a4-6e420a7e0297'),
            new DateTimeValueObject('2021-09-18 05:20:47'),
            [
                'foo' => 'bar',
                'baz' => 'test',
            ]
        );

        $expected = [
            'data' => [
                'messageId' => '80f0f97a-2c84-4eb3-845c-de4997a843f5',
                'type' => 'example',
                'occurredOn' => 1631942447,
                'attributes' => [
                    'aggregateId' => '681db695-2094-490d-85a4-6e420a7e0297',
                    'foo' => 'bar',
                    'baz' => 'test',
                ]
            ]
        ];

        $serializer = new AggregateMessageJsonApiSerializer();

        self::assertEquals(
            \json_encode($expected, JSON_THROW_ON_ERROR),
            $serializer->serialize($aggregateMessage)
        );
    }
}
