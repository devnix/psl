<?php

declare(strict_types=1);

namespace Psl\Clock;

use Psl\Clock\ClockInterface;
use Psl\DateTime;

final readonly class SystemClock implements ClockInterface
{
    private function __construct(private DateTime\Timezone $timezone)
    {
    }

    public static function fromTimezone(DateTime\Timezone $timezone): self
    {
        return new self($timezone);
    }

    public static function fromSystemTimezone(): self
    {
        return new self(DateTime\Timezone::from(date_default_timezone_get()));
    }

    public function now(): DateTime\DateTimeInterface
    {
        return DateTime\DateTime::now($this->timezone);
    }
}
