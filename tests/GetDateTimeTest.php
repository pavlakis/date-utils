<?php

declare(strict_types=1);

namespace Pavlakis\Aikido\Utils\DateTimeHelper\Tests;

use Pavlakis\Aikido\Utils\DateTimeHelper\GetDateTime;
use PHPUnit\Framework\TestCase;

final class GetDateTimeTest extends TestCase
{
    public function testNowUtcReturnsCurrentTimeInUtc(): void
    {
        $before = time();
        $date = GetDateTime::nowUtc();
        $after = time();

        self::assertInstanceOf(\DateTimeImmutable::class, $date);
        self::assertSame('UTC', $date->getTimezone()->getName());
        self::assertGreaterThanOrEqual($before, $date->getTimestamp());
        self::assertLessThanOrEqual($after, $date->getTimestamp());
    }

    public function testCreateUtcFromFormatReturnsDateInUtc(): void
    {
        $date = GetDateTime::createUtcFromFormat('!Y-m-d H:i:s', '2024-01-02 03:04:05');

        self::assertSame('UTC', $date->getTimezone()->getName());
        self::assertSame('2024-01-02 03:04:05', $date->format('Y-m-d H:i:s'));
    }

    public function testCreateUtcFromFormatRejectsInvalidInput(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid format Y-m-d or date not-a-date');

        GetDateTime::createUtcFromFormat('Y-m-d', 'not-a-date');
    }
}
