<?php

declare(strict_types=1);

namespace Psl\Clock;

use Psl\DateTime;
use Psr\Clock\ClockInterface as PsrClockInterface;
use function Psl\invariant;

final class PsrClock implements ClockInterface
{
    public function __construct(private PsrClockInterface $psrClock)
    {
    }

    public function now(): DateTime\DateTimeInterface
    {
        $nativeDateTime = $this->psrClock->now();

        $timestamp = DateTime\Timestamp::fromParts($nativeDateTime->getTimestamp());

        $timezone = $nativeDateTime->getTimezone();

        $timezone = DateTime\Timezone::from($timezone->getName());

        return DateTime\DateTime::fromTimestamp($timestamp, $timezone);
    }
}
