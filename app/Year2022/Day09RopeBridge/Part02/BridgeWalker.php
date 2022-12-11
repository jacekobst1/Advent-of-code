<?php

namespace App\Year2022\Day09RopeBridge\Part02;

class BridgeWalker
{
    private readonly Head $head;
    private array $tailPositions = [];

    public function __construct ()
    {
        $this->head = new Head(0, 0, 9);
    }

    public function executeInstruction(Instruction $instruction): void
    {
        for ($i = 0; $i < $instruction->steps; $i++) {
            $this->head->move($instruction->direction);
            $this->addTailPosition();
        }
    }

    public function getNumberOfVisitedPositions(): int
    {
        return count(array_unique($this->tailPositions));
    }

    private function addTailPosition(): void
    {
        $this->tailPositions[] = $this->head->tailPositionString();
    }
}