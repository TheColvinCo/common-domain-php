<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use PHPUnit\Framework\TestCase;

class CollectionValueObjectTest extends TestCase
{
    public function testThatCollectionIsCountableAndHasTheExpectedCount(): void
    {
        $collection = CollectionValueObjectStub::from(['A', 'B', 'C']);
        static::assertCount(3, $collection);
    }

    public function testThatCollectionReturnsExpectedCount(): void
    {
        $collection = CollectionValueObjectStub::from(['A', 'B', 'C']);
        static::assertEquals(3, $collection->count());
    }

    public function testThatCollectionIsIterable(): void
    {
        $collection = CollectionValueObjectStub::from(['A', 'B', 'C']);
        static::assertIsIterable($collection);
    }

    public function testThatCollectionIteratorHasTheRightValues(): void
    {
        $collection = CollectionValueObjectStub::from(['A', 'B', 'C']);
        static::assertEquals(['A', 'B', 'C'], iterator_to_array($collection->getIterator()));
    }
}