<?php

namespace App\Year2022\Day11MonkeyInTheMiddle\Part02;

use Ds\Collection;
use Ds\Vector;

class Forest
{
    /** @param Vector<Monkey> $monkeys */
    public function __construct (private readonly Vector $monkeys)
    {
    }

    public function startMonkeying(int $rounds): void
    {
        for ($i = 0; $i < $rounds; $i++) {
            $this->executeRound();
        }
    }

    public function getMonkeyBusiness(): int
    {
        $this->monkeys->sort(fn (Monkey $a, Monkey $b) => $a->getInspectedItems() < $b->getInspectedItems());

        return $this->monkeys->get(0)->getInspectedItems() * $this->monkeys->get(1)->getInspectedItems();
    }

    private function executeRound(): void
    {
        foreach ($this->monkeys as $monkey) {
            $monkey->playAround();
        }
    }
}