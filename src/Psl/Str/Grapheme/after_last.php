<?php

declare(strict_types=1);

namespace Psl\Str\Grapheme;

use Psl\Str\Exception;

/**
 * @throws Exception\OutOfBoundsException If the $offset is out-of-bounds.
 * @throws Exception\InvalidArgumentException If $haystack is not made of grapheme clusters.
 *
 * @pure
 */
function after_last(string $haystack, string $needle, int $offset = 0): null|string
{
    $position = search_last($haystack, $needle, $offset);
    if (null === $position) {
        return null;
    }

    $position += length($needle);

    return slice($haystack, $position);
}
