<?php

declare(strict_types=1);

namespace Psl\Tests\Unit\Either;

use PHPUnit\Framework\TestCase;
use Psl\Either\Left;

/**
 * @covers Left
 */
final class LeftTest extends TestCase
{
    public function testIsLeft(): void
    {
        $either = new Left(42);
        static::assertTrue($either->isLeft());
    }

    public function testIsRight(): void
    {
        $either = new Left(42);
        static::assertFalse($either->isRight());
    }

    public function testIsLeftAnd(): void
    {
        $either = new Left(42);
        static::assertTrue($either->isLeftAnd(static fn(int $value) => $value > 40));
        static::assertFalse($either->isLeftAnd(static fn(int $value) => $value < 40));
    }

    public function testIsRightAnd(): void
    {
        $either = new Left(42);
        static::assertFalse($either->isRightAnd(static fn(int $value) => $value > 40));
    }

    public function testGetLeft(): void
    {
        $either = new Left(42);
        static::assertSame(42, $either->getLeft());
    }

    public function testGetRight(): void
    {
        $either = new Left(42);
        static::expectException(\Psl\Either\Exception\RightException::class);
        static::expectExceptionMessage('Cannot get Right value from a Left.');
        $either->getRight();
    }

    public function testGetLeftOr(): void
    {
        $either = new Left(42);
        static::assertSame(42, $either->getLeftOr(100));
    }

    public function testGetRightOr(): void
    {
        $either = new Left(42);
        static::assertSame(100, $either->getRightOr(100));
    }

    public function testProceed(): void
    {
        $either = new Left(42);
        $result = $either->proceed(
            static fn(int $left) => 'Either is left with value ' . $left,
            static fn(int $right) => 'Either is right with value ' . $right,
        );
        static::assertSame('Either is left with value 42', $result);
    }

    public function testMapLeft(): void
    {
        $either = new Left(42);
        $mapped = $either->mapLeft(static fn(int $value) => $value * 2);
        static::assertSame(84, $mapped->getLeft());
    }

    public function testMapRight(): void
    {
        $either = new Left(42);
        $mapped = $either->mapRight(static fn(int $value) => $value * 2);
        static::assertSame(42, $mapped->getLeft());
    }

    public function testSwap(): void
    {
        $either = new Left(42);
        $swapped = $either->swap();
        static::assertTrue($swapped->isRight());
        static::assertSame(42, $swapped->getRight());
    }
}
