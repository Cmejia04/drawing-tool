<?php

namespace App\Service;

use App\Interface\CommandInterface;
use App\Model\Canvas;

class DrawLineHandler implements CommandInterface
{
    public function __construct(
        private int $x1,
        private int $y1,
        private int $x2,
        private int $y2
    )
    {
    }

    public function draw(?Canvas &$canvas): void
    {
        if (!$canvas) {
            throw new \RuntimeException("No canvas created yet");
        }

        if ($canvas->isOutOfRange($this->x1 - 1, $this->y1 - 1) || $canvas->isOutOfRange($this->x2 - 1, $this->y2 - 1)) {
            throw new \RuntimeException("Pixel out of range. Command: L " . $this->x1 . " " . $this->y1 . " " . $this->x2 . " " . $this->y2);
        }

        if ($this->x1 === $this->x2) {
            for ($y = $this->y1 - 1; $y < $this->y2; $y++) {
                $canvas->setPixel($this->x1 - 1, $y);
            }
        } elseif ($this->y1 === $this->y2) {
            for ($x = $this->x1 - 1; $x < $this->x2; $x++) {
                $canvas->setPixel($x, $this->y1 - 1);
            }
        } else {
            throw new \InvalidArgumentException("Only horizontal or vertical lines supported");
        }
    }
}
