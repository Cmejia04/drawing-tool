<?php

namespace App\Service;

use App\Interface\CommandInterface;
use App\Model\Canvas;

class CreateCanvasHandler implements CommandInterface
{
    public function __construct(
        private int $width,
        private int $height
    )
    {
    }

    public function draw(?Canvas &$canvas): void
    {
        if ($this->width <= 1 || $this->height <= 1) {
            throw new \InvalidArgumentException("Canvas dimensions must be greater than 1x1");
        }

        $canvas = new Canvas($this->width, $this->height);
    }
}
