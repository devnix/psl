<?php

namespace Psl\Tests\Benchmark\Collection;

use PhpBench\Attributes\Groups;
use Psl\Collection\MutableMapInterface;
use Psl\Collection\MutableMap;

#[Groups(["collection"])]
class MutableMapBench extends AbstractMapBench
{
    public function benchSet(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        // TODO
        // $map->set(...);
    }
    public function benchSetAll(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        // TODO
        // $map->setAll(...);
    }
    public function benchAdd(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        // TODO
        // $map->add(...);
    }
    public function benchAddAll(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        // TODO
        // $map->addAll(...);
    }
    public function benchRemove(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        // TODO
        // $map->remove(...);
    }
    public function benchClear(): void
    {
        $map = $this->createFromIterable($this->createAssociativeIterable());

        // TODO
        // $map->clear(...);
    }

    protected function createFromIterable(iterable $items): MutableMapInterface
    {
        return MutableMap::fromItems($items);
    }

    protected function createFromArray(array $items): MutableMapInterface
    {
        return MutableMap::fromArray($items);
    }
}
