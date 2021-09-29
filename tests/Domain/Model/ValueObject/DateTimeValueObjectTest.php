<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use Colvin\CommonDomain\Domain\Model\ValueObject\DateTimeValueObject;
use PHPUnit\Framework\TestCase;

class DateTimeValueObjectTest extends TestCase
{
    public function testDateTimeValueObjectSerialization(): void
    {
        $rawDate = '2021-09-22 09:21:38';
        $dateTimeValueObject = DateTimeValueObject::from($rawDate);
        self::assertEquals('2021-09-22T09:21:38+00:00', $dateTimeValueObject->jsonSerialize());

        self::assertEquals(
            $dateTimeValueObject->format(\DateTimeInterface::ATOM),
            $dateTimeValueObject->jsonSerialize()
        );
    }

    public function testDateTimeValueObjectGetTimestamp(): void
    {
        $rawDate = '2021-09-22 09:21:38';
        $dateTimeValueObject = DateTimeValueObject::from($rawDate);
        self::assertEquals(1632302498, $dateTimeValueObject->getTimestamp());
    }

    public function testDateTimeValueObjectDefaultTimeZone(): void
    {
        $dateTimeValueObject = DateTimeValueObject::from('2021-09-22 09:21:38');
        self::assertEquals(new \DateTimeZone('UTC'), $dateTimeValueObject->getTimezone());
    }

    public function testCreateDataTimeValueObjectFromTimestamp(): void
    {
        $dateTimeValueObject = DateTimeValueObject::fromTimestamp(1632302498);
        self::assertEquals('2021-09-22T09:21:38+00:00', $dateTimeValueObject->jsonSerialize());
    }
}
