<?php

declare(strict_types=1);

namespace Psl\Clock;

use Psl\DateTime;

final class FrozenClock implements ClockInterface
{
    public function __construct(private DateTime\DateTime $dateTime)
    {
    }

    public function synchronize(DateTime\DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function now(): DateTime\DateTimeInterface
    {
        return $this->dateTime;
    }
}
