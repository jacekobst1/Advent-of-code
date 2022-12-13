<?php

namespace App\Year2022\Day11MonkeyInTheMiddle\Part01;

use Ds\Vector;

class MonkeyFactory
{
    /** @var Vector<Monkey> $monkeys */
    private readonly Vector $monkeys;
    private Monkey $lastMonkey;

    public function __construct ()
    {
        $this->monkeys = new Vector();
    }

    public function createMonkeysFromFile(mixed $file): Vector
    {
        while (($line = fgets($file)) !== false) {
            $line = str_replace("\n", "", $line);
            $this->processLine(trim($line));
        }

        fseek($file,0);
        while (($line = fgets($file)) !== false) {
            $line = str_replace("\n", "", $line);
            $this->processMonkeysRecipients(trim($line));
        }

        return $this->monkeys;
    }

    private function processLine(string $line): void
    {
        match (true) {
            str_starts_with($line, 'Monkey') => $this->createMonkey($line),
            str_starts_with($line, 'Starting items') => $this->setMonkeyStartingItems($line),
            str_starts_with($line, 'Operation') => $this->setMonkeyOperation($line),
            str_starts_with($line, 'Test') => $this->setMonkeyTest($line),
            default => null,
        };
    }

    private function processMonkeysRecipients(string $line): void
    {
        match (true) {
            str_starts_with($line, 'Monkey') => $this->lastMonkey = $this->monkeys->filter(fn($monkey) => $monkey->number === (int) $line[7])->first(),
            str_starts_with($line, 'If true') => $this->setMonkeyTrueRecipient($line),
            str_starts_with($line, 'If false') => $this->setMonkeyFalseRecipient($line),
            default => null,
        };
    }

    private function createMonkey(string $line): void
    {
        $monkeyNumber = $this->extractNumberFromText($line);
        $monkey = new Monkey($monkeyNumber);
        $this->monkeys->push($monkey);
        $this->lastMonkey = $monkey;
    }

    private function setMonkeyStartingItems(string $line): void
    {
        $line = str_replace("Starting items: ", "", $line);
        $items = explode(', ', $line);

        foreach ($items as $item) {
            $this->lastMonkey->addItem(new Item($item));
        }
    }

    private function setMonkeyOperation(string $line): void
    {
        $op = null;
        $line = str_replace('Operation: new = ', '', $line);
        $opParts = explode(' ', $line);

        $val1 = $opParts[0];
        $sign = $opParts[1];
        $val2 = $opParts[2];

        $getValue = fn (string|int $value, int $replacer) => $value === 'old' ? $replacer : $value;

        if ($sign === '*') {
            $op = fn (int $val) => $getValue($val1, $val) * $getValue($val2, $val);
        } elseif ($sign === '+') {
            $op = fn (int $val) => $getValue($val1, $val) + $getValue($val2, $val);
        }

        $this->lastMonkey->setOperation($op);
    }

    private function setMonkeyTest(string $line): void
    {
        $divisibleBy = $this->extractNumberFromText($line);
        $test = fn (int $value) => $value % $divisibleBy === 0;

        $this->lastMonkey->setTest($test);
    }

    private function setMonkeyTrueRecipient(string $line): void
    {
        $recipientMonkeyNumber = $this->extractNumberFromText($line);
        $recipient = $this->monkeys->filter(fn($monkey) => $monkey->number === $recipientMonkeyNumber)->first();
        $this->lastMonkey->setTrueRecipient($recipient);
    }

    private function setMonkeyFalseRecipient(string $line): void
    {
        $recipientMonkeyNumber = $this->extractNumberFromText($line);
        $recipient = $this->monkeys->filter(fn($monkey) => $monkey->number === $recipientMonkeyNumber)->first();
        $this->lastMonkey->setFalseRecipient($recipient);
    }

    private function extractNumberFromText(string $text): int
    {
        return (int) preg_replace('/[^0-9]/', '', $text);
    }
}