<?php

declare(strict_types=1);

namespace Psl\Str;

use function mb_strpos;

/**
 * Returns the first position of the 'needle' string in the 'haystack' string,
 * or null if it isn't found.
 *
 * An optional offset determines where in the haystack the search begins. If the
 * offset is negative, the search will begin that many characters from the end
 * of the string.
 *
 * @pure
 *
 * @throws Exception\OutOfBoundsException If the $offset is out-of-bounds.
 *
 * @return null|int<0, max>
 */
function search(string $haystack, string $needle, int $offset = 0, Encoding $encoding = Encoding::Utf8): null|int
{
    if ('' === $needle) {
        return null;
    }

    $offset = Internal\validate_offset($offset, length($haystack, $encoding));

    /** @var null|int<0, max> */
    return false === ($pos = mb_strpos($haystack, $needle, $offset, $encoding->value)) ? null : $pos;
}
