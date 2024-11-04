<?php

declare(strict_types=1);

namespace Psl\Clock;

use Psl\DateTime;

interface ClockInterface
{
    public function now(): DateTime\DateTimeInterface;
}
