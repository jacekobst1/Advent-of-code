<?php

namespace App\Year2022\Day10CathodeRayTube\Part02;

class Device
{
    public function __construct (
        private readonly CPU $cpu,
        private readonly Signal $signal,
        private readonly CRT $crt,
    ) {
    }

    public function addCommand(Command $command): void
    {
        $this->cpu->add($command);
    }

    public function work(): void
    {
        do {
            $this->drawCrt();
            $this->computeSignal();
            $this->runCpuCycle();
        } while (!$this->cpu->commandsQueueIsEmpty());
    }

    public function signalStrength(): int
    {
        return $this->signal->getStrength();
    }

    public function showImage(): void
    {
        $this->crt->produceImage();
    }

    private function drawCrt(): void
    {
        $this->crt->draw(
            $this->cpu->getCycle(),
            $this->cpu->getRegister(),
        );
    }

    private function computeSignal(): void
    {
        $this->signal->computeStrength(
            $this->cpu->getCycle(),
            $this->cpu->getRegister(),
        );
    }

    private function runCpuCycle(): void
    {
        $this->cpu->isFree() && $this->cpu->setCommand();
        $this->cpu->processCommand();
    }
}