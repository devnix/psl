<?php

declare(strict_types=1);

namespace Psl\Either;

use Closure;
use Psl;

/**
 * Represents a value of one of two possible types (a disjoint union).
 *
 * An instance of Either is either an instance of Left or Right.
 *
 * Either is often used to represent a value which can be one of two types,
 * where Right represents the "correct" or "successful" value,
 * and Left represents an alternative or "error" case.
 *
 * Unlike Result, which is specifically designed for operations that can fail with a Throwable,
 * Either is more general-purpose and both sides can hold any type of value.
 *
 * This is an interface. You generally get an `EitherInterface<L, R>` by calling constructor
 * methods on implementing classes, and either a `Left<L>` or `Right<R>` is returned.
 *
 * @template L
 * @template R
 */
interface EitherInterface
{
    /**
     * Returns true if this is a Left value.
     *
     * If `isLeft()` returns `true`, `isRight()` returns false.
     *
     * @return bool - `true` if this is a Left; `false` otherwise
     *
     * @phpstan-assert-if-true Left $this
     *
     * @psalm-mutation-free
     */
    public function isLeft(): bool;

    /**
     * Returns true if this is a Right value.
     *
     * If `isRight()` returns `true`, `isLeft()` returns false.
     *
     * @return bool - `true` if this is a Right; `false` otherwise
     *
     * @phpstan-assert-if-true Right $this
     *
     * @psalm-mutation-free
     */
    public function isRight(): bool;

    /**
     * Returns true if this is a Left and the value inside matches the predicate.
     *
     * @param (Closure(L): bool) $predicate
     *
     * @param-immediately-invoked-callable $predicate
     */
    public function isLeftAnd(Closure $predicate): bool;

    /**
     * Returns true if this is a Right and the value inside matches the predicate.
     *
     * @param (Closure(R): bool) $predicate
     *
     * @param-immediately-invoked-callable $predicate
     */
    public function isRightAnd(Closure $predicate): bool;

    /**
     * Returns the Left value.
     *
     * - if this is a Left: return the left value.
     * - if this is a Right: throw an exception.
     *
     * @throws Exception\RightException - When this is a Right value
     *
     * @return L - The left value
     *
     * @psalm-mutation-free
     */
    public function getLeft(): mixed;

    /**
     * Returns the Right value.
     *
     * - if this is a Right: return the right value.
     * - if this is a Left: throw an exception.
     *
     * @throws Exception\LeftException - When this is a Left value
     *
     * @return R - The right value
     *
     * @psalm-mutation-free
     */
    public function getRight(): mixed;

    /**
     * Returns the Left value or the provided default if this is a Right.
     *
     * @template TDefault
     *
     * @param TDefault $default
     *
     * @return L|TDefault
     *
     * @psalm-mutation-free
     */
    public function getLeftOr(mixed $default): mixed;

    /**
     * Returns the Right value or the provided default if this is a Left.
     *
     * @template D
     *
     * @param D $default
     *
     * @return R|D
     *
     * @psalm-mutation-free
     */
    public function getRightOr(mixed $default): mixed;

    /**
     * Matches the contained either value with the provided closures and returns the result.
     *
     * This is the fundamental operation for working with Either values.
     * The implementation will either run the `$left` or `$right` callback.
     * The callback will receive the Left or Right value as an argument,
     * so that you can transform it to anything you want.
     *
     * @template T
     *
     * @param (Closure(L): T) $left  Called when this is a Left value
     * @param (Closure(R): T) $right Called when this is a Right value
     *
     * @param-immediately-invoked-callable $left
     * @param-immediately-invoked-callable $right
     *
     * @return T
     */
    public function proceed(Closure $left, Closure $right): mixed;

    /**
     * Maps the Left value by applying a function.
     *
     * If this is a Right, the function is not called and Right is returned unchanged.
     * If this is a Left, applies the function to the Left value and returns a new Left.
     *
     * @template L2
     *
     * @param (Closure(L): L2) $closure
     *
     * @param-immediately-invoked-callable $closure
     *
     * @return static<L2, R>
     */
    public function mapLeft(Closure $closure): static;

    /**
     * Maps the Right value by applying a function.
     *
     * If this is a Left, the function is not called and Left is returned unchanged.
     * If this is a Right, applies the function to the Right value and returns a new Right.
     *
     * @template R2
     *
     * @param (Closure(R): R2) $closure
     *
     * @param-immediately-invoked-callable $closure
     *
     * @return EitherInterface<L, R2>
     */
    public function mapRight(Closure $closure): EitherInterface;

    /**
     * Swaps Left and Right.
     *
     * If this is a Left, returns a Right with the same value.
     * If this is a Right, returns a Left with the same value.
     *
     * @return EitherInterface<R, L>
     *
     * @psalm-mutation-free
     */
    public function swap(): EitherInterface;
}
