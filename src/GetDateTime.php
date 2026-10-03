<?php

declare(strict_types=1);

namespace Pavlakis\Aikido\Utils\DateTimeHelper;

final class GetDateTime
{
    public static function nowUtc(): \DateTimeImmutable
    {
        return new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
    }

    public static function createUtcFromFormat(string $format, string $dateString): \DateTimeImmutable
    {
        $date = \DateTimeImmutable::createFromFormat($format, $dateString, new \DateTimeZone('UTC'));
        if (!$date instanceof \DateTimeImmutable) {
            throw new \InvalidArgumentException(\sprintf('Invalid format %s or date %s', $format, $dateString));
        }

        return $date;
    }
}
