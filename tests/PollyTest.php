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

    /** @test */
    public function testSample()
    {
        $client = AmazonPolly::getClient();

        $test = $client->synthesizeSpeech([
            'Engine' => 'standard',
            'OutputFormat' => 'mp3', // REQUIRED
            'Text' => 'test', // REQUIRED
            'TextType' => 'text',
            'VoiceId' => 'Amy', // REQUIRED
        ]);

        dd($test->get('AudioStream')->getContents());
    }
}