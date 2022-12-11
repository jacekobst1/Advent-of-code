<?php

namespace App\Year2022\Day10CathodeRayTube\Part01;

use Ds\Queue;

/** @var Queue<Command> $commands  */
class CPU
{
    private int $register = 1;
    private int $cycle = 1;
    private int $remainingExecutionCycles = 0;

    private Queue $commands;
    private Command $currentCommand;

    private readonly array $signalCheckPoints;
    private int $signalStrength = 0;

    public function __construct ()
    {
        $this->commands = new Queue();
        $this->signalCheckPoints = [20, 60, 100, 140, 180, 220];
    }

    public function signalStrength(): int
    {
        return $this->signalStrength;
    }

    public function add(Command $command): void
    {
        $this->commands->push($command);
    }

    public function work(): void
    {
        do {
            $this->checkSignal();
            $this->cpuIsFree() && $this->setCommand();
            $this->processCommand();
        } while (!$this->commands->isEmpty());
    }

    private function checkSignal(): void
    {
        if (in_array($this->cycle, $this->signalCheckPoints)) {
            $this->signalStrength += ($this->cycle * $this->register);
        }
    }

    private function cpuIsFree(): bool
    {
        return $this->remainingExecutionCycles === 0;
    }

    private function setCommand(): void
    {
        $command = $this->commands->pop();
        $this->currentCommand = $command;
        $this->remainingExecutionCycles += $command->cycles();
    }

    private function processCommand(): void
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