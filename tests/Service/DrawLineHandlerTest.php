<?php

namespace App\Tests\Service;

use App\Model\Canvas;
use App\Service\DrawLineHandler;
use PHPUnit\Framework\TestCase;

class DrawLineHandlerTest extends TestCase
{
    public function testDrawHorizontalLine(): void
    {
        $canvas = new Canvas(5, 5);

        $handler = new DrawLineHandler(1, 1, 5, 1);
        $handler->draw($canvas);

        for ($x = 0; $x < 5; $x++) {
            $this->assertEquals('x', $canvas->getPixel($x, 0));
        }
    }

    public function testDrawVerticalLine(): void
    {
        $canvas = new Canvas(5, 5);

        $handler = new DrawLineHandler(1, 1, 1, 4);
        $handler->draw($canvas);

        for ($y = 0; $y < 4; $y++) {
            $this->assertEquals('x', $canvas->getPixel(0, $y));
        }
    }

    public function testInvalidDiagonalLineThrowsException(): void
    {
        $canvas = new Canvas(5, 5);

        $handler = new DrawLineHandler(1, 1, 3, 3);

        $this->expectException(\InvalidArgumentException::class);
        $handler->draw($canvas);
    }

    public function testDrawLineWithoutCanvasThrowsException(): void
    {
        $handler = new DrawLineHandler(1, 1, 1, 3);
        $canvas = null;

        $this->expectException(\RuntimeException::class);
        $handler->draw($canvas);
    }
}
