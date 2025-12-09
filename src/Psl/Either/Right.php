<?php

declare(strict_types=1);

namespace Psl\Either;

use Closure;

/**
 * Represents the right side of an Either.
 *
 * By convention, Right is used to hold the primary or successful value,
 * while {@see Left} holds an alternative value or error case.
 *
 * @template    R
 *
 * @implements  EitherInterface<never, R>
 */
final readonly class Right implements EitherInterface
{
    /**
     * @param R $value
     *
     * @psalm-mutation-free
     */
    public function __construct(
        private mixed $value,
    ) {}

    public function isLeft(): bool
    {
        return false;
    }

    public function isRight(): bool
    {
        return true;
    }

    public function isLeftAnd(Closure $predicate): bool
    {
        return false;
    }

    public function isRightAnd(Closure $predicate): bool
    {
        return $predicate($this->value);
    }

    public function getLeft(): mixed
    {
        throw new Exception\LeftException('Cannot get Left value from a Right.');
    }

    /**
     * @throws void
     */
    public function getRight(): mixed
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
    public function getLeftOr(mixed $default): mixed
    {
        return $default;
    }

    /**
     * @return R
     */
    public function getRightOr(mixed $default): mixed
    {
        return $this->value;
    }

    public function proceed(Closure $left, Closure $right): mixed
    {
        return $right($this->value);
    }

    public function mapLeft(Closure $closure): static
    {
        return $this;
    }

    public function mapRight(Closure $closure): static
    {
        return new self($closure($this->value));
    }

    /**
     * @return Left<R>
     */
    public function swap(): Left
    {
        return new Left($this->value);
    }
}
