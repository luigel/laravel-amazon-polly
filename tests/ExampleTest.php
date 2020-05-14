<?php

namespace Luigel\LaravelAmazonPolly\Tests;

use Orchestra\Testbench\TestCase;
use Luigel\LaravelAmazonPolly\LaravelAmazonPollyServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelAmazonPollyServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
