<?php

namespace App\Interface;

use App\Model\Canvas;

interface CommandInterface
{
    public function draw(?Canvas &$canvas): void;
}
