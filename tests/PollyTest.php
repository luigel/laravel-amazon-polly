<?php

namespace Luigel\AmazonPolly\Tests;

use Luigel\AmazonPolly\Facades\AmazonPolly;

class PollyTest extends PollyTestCase
{
    /** @test */
    public function it_can_create_client()
    {
        $client = AmazonPolly::getClient();

        $this->assertInstanceOf(\Aws\Polly\PollyClient::class, $client);
    }
}