<?php

namespace Luigel\AmazonPolly\Tests;

use Orchestra\Testbench\TestCase;
use Luigel\AmazonPolly\AmazonPollyServiceProvider;

class PollyTestCase extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [AmazonPollyServiceProvider::class];
    }
}
