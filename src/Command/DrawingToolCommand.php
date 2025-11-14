<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\BucketFillHandler;
use App\Service\CreateCanvasHandler;
use App\Service\DrawLineHandler;
use App\Service\DrawRectangleHandler;
use App\Interface\CommandInterface;
use App\Model\Canvas;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:drawing_tool')]
class DrawingToolCommand extends Command
{
    private ?Canvas $canvas = null;
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFile = __DIR__ . '/../../input.txt';
        $outputFile = __DIR__ . '/../../output.txt';

        $lines = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $command = $this->parseCommand($line);

            if (!$this->canvas && !($command instanceof CreateCanvasHandler)) {
                echo "Skipping command before canvas is created: $line\n";
                continue;
            }

            $command->draw($this->canvas);
        }

        if ($this->canvas) {
            file_put_contents($outputFile, $this->canvas->render());
        }

        return Command::SUCCESS;
    }

    private function parseCommand(string $line): CommandInterface
    {
        $parts = explode(' ', $line);
        $cmd = strtoupper(array_shift($parts));

        return match ($cmd) {
            'C' => new CreateCanvasHandler((int) $parts[0], (int) $parts[1]),
            'L' => new DrawLineHandler((int) $parts[0], (int) $parts[1], (int) $parts[2], (int) $parts[3]),
            'R' => new DrawRectangleHandler((int) $parts[0], (int) $parts[1], (int) $parts[2], (int) $parts[3]),
            'B' => new BucketFillHandler((int) $parts[0], (int) $parts[1], $parts[2]),
            default => throw new \InvalidArgumentException("Unknown command: $cmd")
        };
    }
}
