<?php

namespace Psl\Tests\Benchmark\Collection;

use PhpBench\Attributes\Groups;
use Psl\Collection\MapInterface;
use Psl\Collection\Map;

#[Groups(["collection"])]
class MapBench extends AbstractMapBench
{
    protected function createFromIterable(iterable $items): MapInterface
    {
        return Map::fromItems($items);
    }

    protected function createFromArray(array $items): MapInterface
    {
        return Map::fromArray($items);
    }
}
