<?php

namespace App\Tests\Service;

use App\Model\Canvas;
use App\Service\BucketFillHandler;
use App\Service\DrawRectangleHandler;
use PHPUnit\Framework\TestCase;

class BucketFillHandlerTest extends TestCase
{
    public function testBucketFillInsideRectangle(): void
    {
        $canvas = new Canvas(10, 10);

        $rectHandler = new DrawRectangleHandler(2, 2, 5, 5);
        $rectHandler->draw($canvas);

        $handler = new BucketFillHandler(3, 3, 'o');
        $handler->draw($canvas);

        for ($y = 1; $y < 5; $y++) {
            for ($x = 1; $x < 5; $x++) {
                if ($canvas->getPixel($x, $y) !== 'x') {
                    $this->assertEquals('o', $canvas->getPixel($x, $y));
                }
            }
        }
    }

    public function testBucketFillWithoutCanvasThrowsException(): void
    {
        $handler = new BucketFillHandler(1, 1, 'o');
        $canvas = null;

        $this->expectException(\RuntimeException::class);
        $handler->draw($canvas);
    }
}
