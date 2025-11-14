<?php

namespace App\Tests\Service;

use App\Model\Canvas;
use App\Service\CreateCanvasHandler;
use PHPUnit\Framework\TestCase;

class CreateCanvasHandlerTest extends TestCase
{
    public function testCreateCanvasCreatesNewCanvas(): void
    {
        $handler = new CreateCanvasHandler(10, 4);

        $canvas = null;
        $handler->draw($canvas);

        $this->assertInstanceOf(Canvas::class, $canvas);
        $this->assertEquals(10, $canvas->getWidth());
        $this->assertEquals(4, $canvas->getHeight());
    }

    public function testCreateCanvasWithInvalidSizeThrowsException(): void
    {
        $handler = new CreateCanvasHandler(0, 0);

        $this->expectException(\InvalidArgumentException::class);

        $canvas = null;
        $handler->draw($canvas);
    }
}
