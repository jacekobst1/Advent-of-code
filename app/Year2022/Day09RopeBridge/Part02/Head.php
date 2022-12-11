<?php

namespace App\Year2022\Day09RopeBridge\Part02;

class Head implements RopePart
{
    private int $x;
    private int $y;
    private readonly Knot $knot;

    public function __construct(int $x, int $y, int $numberOfKnotsToCreate = 1)
    {
        $this->x = $x;
        $this->y = $y;
        $this->knot = new Knot($x, $y, $numberOfKnotsToCreate);
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
        return $this->knot->tailPositionString();
    }

    public function move(Direction $direction): void
    {
        match ($direction) {
            Direction::RIGHT => $this->x++,
            Direction::LEFT => $this->x--,
            Direction::UP => $this->y++,
            Direction::DOWN => $this->y--,
        };

        $this->knot->followRopePart($this);
    }
}