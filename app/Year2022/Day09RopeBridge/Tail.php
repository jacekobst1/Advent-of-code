<?php

namespace App\Year2022\Day09RopeBridge;

class Tail
{
    public function __construct(
        private int $x,
        private int $y
    ) {
    }

    public function positionString(): string
    {
        return "$this->x,$this->y";
    }

    public function followHead(Head $head): void
    {
        $distanceDiff = $this->getDistanceDiff($head);

        if ($this->headIsTooFarHorizontally($distanceDiff['x'])) {
            $this->followHeadHorizontally($head);
            return;
        }

        if ($this->headIsTooFarVertically($distanceDiff['y'])) {
            $this->followHeadVertically($head);
        }
    }

    private function getDistanceDiff(Head $head): array
    {
        $invertSign = fn (&$number) => $number = -$number;

        $xDiff =  $head->getX() - $this->x;
        $yDiff =  $head->getY() - $this->y;

        if ($xDiff < 0) {
            $invertSign($xDiff);
        }

        if ($yDiff < 0) {
            $invertSign($yDiff);
        }

        return [
            'x' => $xDiff,
            'y' => $yDiff,
        ];
    }

    private function headIsTooFarHorizontally(int $xDiff): bool
    {
        return $xDiff >= 2;
    }

    private function headIsTooFarVertically(int $yDiff): bool
    {
        return $yDiff >= 2;
    }

    private function followHeadHorizontally(Head $head): void
    {
        $this->catchUpHorizontally($head->getX());
        $this->alignVertically($head->getY());
    }

    private function followHeadVertically(Head $head): void
    {
        $this->catchUpVertically($head->getY());
        $this->alignHorizontally($head->getX());
    }

    private function catchUpHorizontally(int $headX): void
    {
        if ($headX > $this->x) {
            $this->x = $headX - 1;
        }

        if ($headX < $this->x) {
            $this->x = $headX + 1;
        }
    }

    private function catchUpVertically(int $headY): void
    {
        if ($headY > $this->y) {
            $this->y = $headY - 1;
        }

        if ($headY < $this->y) {
            $this->y = $headY + 1;
        }
    }

    private function alignHorizontally(int $headX): void
    {
        if ($headX != $this->x) {
            $this->x = $headX;
        }
    }

    private function alignVertically(int $headY): void
    {
        if ($headY != $this->y) {
            $this->y = $headY;
        }
    }
}