<?php

declare(strict_types=1);

namespace Psl\Either;

use Closure;

/**
 * Represents the left side of an Either.
 *
 * By convention, Left is used to hold an alternative value or error case,
 * while {@see Right} holds the primary or successful value.
 *
 * @template    L
 *
 * @implements  EitherInterface<L, never>
 */
final readonly class Left implements EitherInterface
{
    /**
     * @param L $value
     *
     * @psalm-mutation-free
     */
    public function __construct(
        private mixed $value,
    ) {}

    public function isLeft(): bool
    {
        return true;
    }

    public function isRight(): bool
    {
        return false;
    }

    public function isLeftAnd(Closure $predicate): bool
    {
        return $predicate($this->value);
    }

    public function isRightAnd(Closure $predicate): bool
    {
        return false;
    }

    /**
     * @throws void
     */
    public function getLeft(): mixed
    {
        return $this->value;
    }

    public function getRight(): mixed
    {
        throw new Exception\RightException('Cannot get Right value from a Left.');
    }

    /**
     * @return L
     */
    public function getLeftOr(mixed $default): mixed
    {
        return $this->value;
    }

    /**
     * @template TDefault
     *
     * @param TDefault $default
     *
     * @return TDefault
     */
    public function getRightOr(mixed $default): mixed
    {
        return $default;
    }

    public function proceed(Closure $left, Closure $right): mixed
    {
        return $left($this->value);
    }

    public function mapLeft(Closure $closure): static
    {
        return new self($closure($this->value));
    }

    public function mapRight(Closure $closure): static
    {
        return $this;
    }

    /**
     * @return Right<L>
     */
    public function swap(): Right
    {
        return new Right($this->value);
    }
}
