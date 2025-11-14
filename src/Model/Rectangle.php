<?php

namespace App\Model;

class Rectangle
{
    public function __construct(
        private int $x1,
        private int $y1,
        private int $x2,
        private int $y2
    ) {}

    public function getX1(): int
    {
        return $this->x1;
    }

    public function getY1(): int
    {
        return $this->y1;
    }

    public function getX2(): int
    {
        return $this->x2;
    }

    public function getY2(): int
    {
        return $this->y2;
    }



    public function contains(int $x, int $y): bool
    {
        return $x >= $this->x1 && $x <= $this->x2 && $y >= $this->y1 && $y <= $this->y2;
    }
}