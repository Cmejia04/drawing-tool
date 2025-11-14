<?php

namespace App\Model;

use App\Model\Rectangle\RectangleRegistry;

class Canvas
{
    private int $width;

    private int $height;

    private ?array $pixels = null;

    private ?RectangleRegistry $rectangles = null;

    public function __construct(
        int $width,
        int $height
    )
    {
        if ($width <= 0 || $height <= 0) {
            throw new \InvalidArgumentException("Canvas dimensions must be positive");
        }

        $this->width = $width;
        $this->height = $height;
        $this->pixels = array_fill(0, $height, array_fill(0, $width, ' '));
        $this->rectangles = $rectangles ?? new RectangleRegistry();
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getPixel(int $x, int $y): string
    {
        if ($this->isOutOfRange($x, $y)) {
            throw new \InvalidArgumentException("Canvas pixels out of bounds");
        }
        return $this->pixels[$y][$x];
    }

    public function setPixel(int $x, int $y, string $char = 'x'): void
    {
        if ($this->isOutOfRange($x, $y)) {
            throw new \InvalidArgumentException("Canvas pixels out of bounds");
        }

        $this->pixels[$y][$x] = $char;
    }

    public function getRectangles(): ?RectangleRegistry
    {
        return $this->rectangles;
    }

    public function isOutOfRange(int $x, int $y): bool
    {
        return $x < 0 || $x >= $this->width || $y < 0 || $y >= $this->height;
    }

    public function render(): string
    {
        $output = str_repeat('-', $this->width + 2) . PHP_EOL;
        foreach ($this->pixels as $row) {
            $output .= '|' . implode('', $row) . '|' . PHP_EOL;
        }
        $output .= str_repeat('-', $this->width + 2) . PHP_EOL;

        return $output;
    }

}