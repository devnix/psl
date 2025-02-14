<?php

declare(strict_types=1);

namespace Psl\Str\Byte;

use Psl\Str\Exception;

/**
 * @throws Exception\OutOfBoundsException If the $offset is out-of-bounds.
 *
 * @pure
 */
function after_ci(string $haystack, string $needle, int $offset = 0): null|string
{
    $position = search_ci($haystack, $needle, $offset);
    if (null === $position) {
        return null;
    }

    $position += length($needle);

    return slice($haystack, $position);
}
