<?php

namespace App\Service;

use App\Interface\CommandInterface;
use App\Model\Canvas;

class BucketFillHandler implements CommandInterface
{
    public function __construct(
        private int $x,
        private int $y,
        private string $char = '*')
    {
    }

    public function draw(?Canvas &$canvas): void
    {
        if (!$canvas) {
            throw new \RuntimeException("No canvas created yet");
        }

        if ($canvas->isOutOfRange($this->x - 1, $this->y - 1)) {
            throw new \RuntimeException("Pixel out of range. Command: B Command: R " . $this->x . " " . $this->y . " " . $this->char);
        }

        if ($canvas->getRectangles()->getAll()){
            $rectangle = $canvas->getRectangles()->findContaining($this->x, $this->y);

            if ($rectangle) {
                for ($y = $rectangle->getY1() - 1; $y < $rectangle->getY2(); $y++) {
                    for ($x = $rectangle->getX1() - 1; $x < $rectangle->getX2(); $x++) {
                        if ($canvas->getPixel($x, $y) === ' ') {
                            $canvas->setPixel($x, $y, $this->char);
                        }
                    }
                }
            } elseif ($this->x > 0 && $this->y > 0) {
                $this->fillEmptyCells($canvas);
            }
        } elseif ($this->x > 0 && $this->y > 0) {
            $this->fillEmptyCells($canvas);
        }
    }

    public function fillEmptyCells(Canvas $canvas): void
    {
        for ($y = 0; $y < $canvas->getHeight(); $y++) {
            for ($x = 0; $x < $canvas->getWidth(); $x++) {
                if ($canvas->getPixel($x, $y) === ' ' && !$canvas->getRectangles()->findContaining($x + 1, $y + 1)) {
                    $canvas->setPixel($x, $y, $this->char);
                }
            }
        }
    }
}
