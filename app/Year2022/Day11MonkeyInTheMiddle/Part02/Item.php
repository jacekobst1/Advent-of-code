<?php

namespace App\Year2022\Day11MonkeyInTheMiddle\Part02;

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
//        $this->worryLevel = (int) floor($this->worryLevel / 3);
        $this->worryLevel = $this->worryLevel % array_product([19, 7, 17, 13, 11, 2, 5, 3]);
    }
}