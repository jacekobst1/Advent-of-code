<?php

namespace App\Year2022\Day09RopeBridge\Part01;

class Head
{
    private int $x;
    private int $y;
    private readonly Tail $tail;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->tail = new Tail($x, $y);
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
        return $this->tail->positionString();
    }

    public function move(Direction $direction): void
    {
        match ($direction) {
            Direction::RIGHT => $this->x++,
            Direction::LEFT => $this->x--,
            Direction::UP => $this->y++,
            Direction::DOWN => $this->y--,
        };

        $this->tail->followHead($this);
    }
}