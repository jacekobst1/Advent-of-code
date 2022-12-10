<?php

namespace App\Year2022\Day09RopeBridge;

class Instruction
{
    public function __construct (public readonly Direction $direction, public readonly int $steps)
    {
    }
}