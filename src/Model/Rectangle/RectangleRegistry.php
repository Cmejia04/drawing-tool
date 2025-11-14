<?php

namespace App\Model\Rectangle;

use App\Model\Rectangle;

class RectangleRegistry
{
    private array $rectangles = [];

    public function getAll(): array
    {
        return $this->rectangles;
    }

    public function add(Rectangle $rectangle): void
    {
        $this->rectangles[] = $rectangle;
    }

    public function findContaining(int $x, int $y): ?Rectangle
    {
        /** @var Rectangle $rectangle */
        foreach ($this->rectangles as $rectangle) {
            if ($rectangle->contains($x, $y)) {
                return $rectangle;
            }
        }
        return null;
    }
}