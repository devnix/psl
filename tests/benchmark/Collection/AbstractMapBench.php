<?php

namespace Psl\Tests\Benchmark\Collection;

use PhpBench\Attributes\Groups;
use PhpBench\Attributes\ParamProviders;
use Psl\Collection\MapInterface;
use function Psl\Vec\map;

abstract class AbstractMapBench
{
    /**
     * @param iterable<array-key, mixed> $data
     */
    public function benchFromArray(): void
    {
        map($this->getDataProviders(), fn ($value) => $this->createFromArray(iterator_to_array($value)));
    }

    public function benchFromIterable(): void
    {
        map($this->getDataProviders(), fn ($value) => $this->createFromIterable($value));
    }

    public function benchmarkValues(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());
        $map->values();
    }

    public function benchmarkKeys(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->keys();
    }

    public function benchmarkFilter(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->filter(fn ($v) => $v === 'a');
        $map->filter(fn ($v) => $v === 'k');
        $map->filter(fn ($v) => $v === 'foo');
    }

    public function benchmarkMap(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->map(fn ($v) => $v);
    }

    public function benchmarkMapWithKey(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->mapWithKey(fn ($k, $v) => [$k, $v]);
    }

    public function benchmarkFirst(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->first();
    }

    public function benchmarkFirstKey(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->firstKey();
    }

    public function benchmarkLast(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->last();
    }

    public function benchmarkLastKey(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->lastKey();
    }

    public function benchmarkLinearSearch(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->linearSearch('a');
        $map->linearSearch('k');
        $map->linearSearch('lol');
    }

    public function benchmarkZip(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->zip([]);
        $map->zip(['z', 'y', 'x']);
    }

    public function benchmarkTake(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->take(0);
        $map->take(1);
        $map->take(5);
        $map->take(1000);
    }

    public function benchmarkTakeWhile(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->takeWhile(fn ($v) => 'a');
        $map->takeWhile(fn ($v) => 'k');
        $map->takeWhile(fn ($v) => 'rolf');
        $map->takeWhile(fn ($v) => true);
        $map->takeWhile(fn ($v) => false);
    }

    public function benchmarkDrop(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->drop(0);
        $map->drop(1);
        $map->drop(8);
        $map->drop(1000);
    }

    public function benchmarkDropWhile(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->dropWhile(fn ($v) => 'a');
        $map->dropWhile(fn ($v) => 'k');
        $map->dropWhile(fn ($v) => 'rolf');
        $map->dropWhile(fn ($v) => true);
        $map->dropWhile(fn ($v) => false);
    }

    public function benchmarkSlice(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->slice(0, 10);
        $map->slice(5, 10);
        $map->slice(15, 10);
        $map->slice(1000, 100);
    }

    public function benchmarkChunk(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        $map->chunk(1);
        $map->chunk(2);
        $map->chunk(3);
        $map->chunk(10);
        $map->chunk(1000);
    }

    /**
     * @return array<string, array<array-key, mixed>>
     */
    public function getDataProviders(): array
    {
        return [
            'empty array' => [$this->createEmptyIterable()],
            'list' => [$this->createNumericIterable()],
            'associative' => [$this->createAssociativeIterable()],
        ];
    }

    public function createEmptyIterable(): iterable
    {
        yield from [];
    }

    /**
     * @template     Tk of array-key
     * @template     Tv
     *
     * @param iterable<Tk, Tv> $items
     *
     * @return MapInterface<Tk, Tv>
     */
    abstract protected function createFromIterable(iterable $items): MapInterface;

    /**
     * @template     Tk of array-key
     * @template     Tv
     *
     * @param array<Tk, Tv> $items
     *
     * @return MapInterface<Tk, Tv>
     */
    abstract protected function createFromArray(array $items): MapInterface;

    /**
     * @return \Generator
     */
    function createNumericIterable(): \Generator
    {
        yield 'a';
        yield 'b';
        yield 'c';
        yield 'd';
        yield 'e';
        yield 'f';
        yield 'g';
        yield 'h';
        yield 'i';
        yield 'j';
        yield 'k';
    }

    /**
     * @return \Generator
     */
    function createAssociativeIterable(): \Generator
    {
        yield 'a' => 'a';
        yield 'b' => 'b';
        yield 'c' => 'c';
        yield 'd' => 'd';
        yield 'e' => 'e';
        yield 'f' => 'f';
        yield 'g' => 'g';
        yield 'h' => 'h';
        yield 'i' => 'i';
        yield 'j' => 'j';
        yield 'k' => 'k';
    }
}
