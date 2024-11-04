<?php

declare(strict_types=1);

namespace Psl\Tests\Unit\Clock;

use Psl\Clock\PsrClock;
use PHPUnit\Framework;
use Psr\Clock\ClockInterface as PsrClockInterface;
use Psl\DateTime;

final class PsrClockTest extends Framework\TestCase
{
    public function testNow(): void
    {
        $clock = new PsrClock(
            new FixedPsrClock(
                new \DateTimeImmutable('2020-01-01 00:00:00', new \DateTimeZone('Africa/Tunis'))
            )
        );

        self::assertTrue(
            $clock->now()->equalsIncludingTimezone(
                DateTime\DateTime::parse(
                    '2020-01-01 00:00:00',
                    DateTime\FormatPattern::SqlDateTime,
                    DateTime\Timezone::AfricaTunis,
                )
            )
        );
    }
}

class FixedPsrClock implements PsrClockInterface
{
    public function __construct(private readonly \DateTimeImmutable $now)
    {
    }

    public function now(): \DateTimeImmutable
    {
        return $this->now;
    }
}
