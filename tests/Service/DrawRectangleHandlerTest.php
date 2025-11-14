<?php

namespace App\Tests\Service;

use App\Model\Canvas;
use App\Service\DrawRectangleHandler;
use PHPUnit\Framework\TestCase;

class DrawRectangleHandlerTest extends TestCase
{
    public function testDrawRectangle(): void
    {
        $canvas = new Canvas(6, 6);

        $handler = new DrawRectangleHandler(2, 2, 5, 5);
        $handler->draw($canvas);

        // Top border
        for ($x = 1; $x < 5; $x++) {
            $this->assertEquals('x', $canvas->getPixel($x, 1));
        }

        // Bottom border
        for ($x = 1; $x < 5; $x++) {
            $this->assertEquals('x', $canvas->getPixel($x, 4));
        }

        // Left border
        for ($y = 1; $y < 5; $y++) {
            $this->assertEquals('x', $canvas->getPixel(1, $y));
        }

        // Right border
        for ($y = 1; $y < 5; $y++) {
            $this->assertEquals('x', $canvas->getPixel(4, $y));
        }
    }

    public function testDrawRectangleWithoutCanvasThrowsException(): void
    {
        $handler = new DrawRectangleHandler(1, 1, 3, 3);
        $canvas = null;

        $this->expectException(\RuntimeException::class);
        $handler->draw($canvas);
    }
}
