<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        return $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    }
}
