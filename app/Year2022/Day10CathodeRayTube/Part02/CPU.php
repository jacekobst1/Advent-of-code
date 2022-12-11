<?php

namespace App\Year2022\Day10CathodeRayTube\Part02;

use Ds\Queue;

/** @var Queue<Command> $commands  */
class CPU
{
    private int $register = 1;
    private int $cycle = 1;
    private int $remainingExecutionCycles = 0;
    private Queue $commands;
    private Command $currentCommand;

    public function __construct ()
    {
        $this->commands = new Queue();
    }

    public function getRegister(): int
    {
        return $this->register;
    }

    public function getCycle(): int
    {
        return $this->cycle;
    }

    public function add(Command $command): void
    {
        $this->commands->push($command);
    }

    public function commandsQueueIsEmpty(): bool
    {
        return $this->commands->count() === 0;
    }

    public function isFree(): bool
    {
        return $this->remainingExecutionCycles === 0;
    }

    public function setCommand(): void
    {
        $command = $this->commands->pop();
        $this->currentCommand = $command;
        $this->remainingExecutionCycles += $command->cycles();
    }

    public function processCommand(): void
    {
        $this->remainingExecutionCycles--;

        if ($this->remainingExecutionCycles === 0) {
            $this->modifyRegister($this->currentCommand->value);
        }

        $this->cycle++;
    }

    private function modifyRegister(?int $value): void
    {
        if ($value) {
            $this->register += $value;
        }
    }
}