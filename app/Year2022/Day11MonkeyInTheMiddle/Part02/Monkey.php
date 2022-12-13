<?php

namespace App\Year2022\Day11MonkeyInTheMiddle\Part02;

use Closure;
use Ds\Queue;

class Monkey
{
    public readonly int $number;
    private int $inspectedItems = 0;

    /** @var Queue<Item> $items */
    private readonly Queue $items;

    private readonly Closure $operation;

    private readonly Closure $test;

    private Monkey $trueRecipient;

    private Monkey $falseRecipient;

    public function __construct (int $number)
    {
        $this->number = $number;
        $this->items = new Queue();
    }

    public function getInspectedItems(): int
    {
        return $this->inspectedItems;
    }

    public function setOperation(Closure $operation): void
    {
        $this->operation = $operation;
    }

    public function setTest(Closure $test): void
    {
        $this->test = $test;
    }

    public function setTrueRecipient(Monkey $trueRecipient): void
    {
        $this->trueRecipient = $trueRecipient;
    }

    public function setFalseRecipient(Monkey $falseRecipient): void
    {
        $this->falseRecipient = $falseRecipient;
    }

    public function addItem(Item $item): void
    {
        $this->items->push($item);
    }

    public function playAround(): void
    {
        while (!$this->items->isEmpty()) {
            $item = $this->items->pop();
            $this->inspect($item);
            $this->getBored($item);
            $this->throwAway($item);
        }
    }

    private function inspect(Item $item): void
    {
        $worryLevel = $item->getWorryLevel();
        $newWorryLevel = ($this->operation)($worryLevel);
        $item->setWorryLevel($newWorryLevel);
        $this->inspectedItems++;
    }

    private function getBored(Item $item): void
    {
        $item->relief();
    }

    private function throwAway(Item $item): void
    {
        $worryLevel = $item->getWorryLevel();
        $testResult = ($this->test)($worryLevel);

        if ($testResult) {
            $this->trueRecipient->addItem($item);
        } else {
            $this->falseRecipient->addItem($item);
        }
    }
}