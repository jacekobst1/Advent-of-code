<?php

namespace App\Year2022\Day09RopeBridge\Part02;

class Knot implements RopePart
{
    private int $x;
    private int $y;
    private readonly ?Knot $nextKnot;

    public function __construct(
        int $x,
        int $y,
        int $numberOfKnotsToCreate = 0,
    ) {
        $this->x = $x;
        $this->y = $y;

        $numberOfKnotsToCreate--;
        if ($numberOfKnotsToCreate > 0) {
            $this->nextKnot = new Knot($x, $y, $numberOfKnotsToCreate);
        } else {
            $this->nextKnot = null;
        }
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function tailPositionString(): string
    {
        return $this->nextKnot?->tailPositionString() ?? "$this->x,$this->y";
    }

    public function followRopePart(RopePart $ropePart): void
    {
        $distanceDiff = $this->getDistanceDiff($ropePart);

        if ($this->ropePartIsTooFarDiagonally($distanceDiff)) {
            $this->followRopePartDiagonally($ropePart);
        }

        if ($this->ropePartIsTooFarHorizontally($distanceDiff)) {
            $this->followRopePartHorizontally($ropePart);
        }

        if ($this->ropePartIsTooFarVertically($distanceDiff)) {
            $this->followRopePartVertically($ropePart);
        }

        $this->nextKnot?->followRopePart($this);
    }

    private function getDistanceDiff(RopePart $ropePart): array
    {
        $invertSign = fn (&$number) => $number = -$number;

        $xDiff =  $ropePart->getX() - $this->x;
        $yDiff =  $ropePart->getY() - $this->y;

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

    private function ropePartIsTooFarDiagonally(array $diff): bool
    {
        return
            ($diff['x'] >= 2 && $diff['y'] !== 0)
            or
            ($diff['x'] !== 0 && $diff['y'] >= 2);
    }


    private function ropePartIsTooFarHorizontally(array $diff): bool
    {
        return $diff['x'] >= 2 && $diff['y'] === 0;
    }

    private function ropePartIsTooFarVertically(array $diff): bool
    {
        return $diff['x'] === 0 && $diff['y'] >= 2;
    }

    private function followRopePartDiagonally(RopePart $ropePart): void
    {
        $this->catchUpHorizontally($ropePart->getX());
        $this->catchUpVertically($ropePart->getY());
    }

    private function followRopePartHorizontally(RopePart $ropePart): void
    {
        $this->catchUpHorizontally($ropePart->getX());
    }

    private function followRopePartVertically(RopePart $ropePart): void
    {
        $this->catchUpVertically($ropePart->getY());
    }

    private function catchUpHorizontally(int $ropePartX): void
    {
        if ($ropePartX > $this->x) {
            $this->x++;
        }

        if ($ropePartX < $this->x) {
            $this->x--;
        }
    }

    private function catchUpVertically(int $ropePartY): void
    {
        if ($ropePartY > $this->y) {
            $this->y++;
        }

        if ($ropePartY < $this->y) {
            $this->y--;
        }
    }
}