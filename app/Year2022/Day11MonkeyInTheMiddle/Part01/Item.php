<?php

namespace App\Year2022\Day11MonkeyInTheMiddle\Part01;

class Item
{
    public function __construct (private int $worryLevel)
    {
    }

    public function getWorryLevel(): int
    {
        return $this->worryLevel;
    }

    public function setWorryLevel(int $worryLevel): void
    {
        $this->worryLevel = $worryLevel;
    }

    public function relief(): void
    {
        $this->worryLevel = (int) floor($this->worryLevel / 3);
    }
}