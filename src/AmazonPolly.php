<?php

namespace Luigel\AmazonPolly;

class AmazonPolly
{
    /**
     * @var \Aws\Polly\PollyClient
     */
    private $client;

    public function __construct(array $config)
    {
        $credentials = $this->getCredentials($config['credentials']);

        $this->client = new \Aws\Polly\PollyClient(['version' => $config['version'], 'credentials' => $credentials, 'region' => $config['region']]);
    }

    /**
     * Get credentials of AWS
     *
     * @param array $credentials
     * @return \Aws\Credentials\Credentials
     */
    protected function getCredentials(array $credentials)
    {
        return new \Aws\Credentials\Credentials($credentials['key'], $credentials['secret']);
    }

    /**
     * Get the Polly Client
     *
     * @return \Aws\Polly\PollyClient
     */
    public function getClient(): \Aws\Polly\PollyClient
    {
        return $this->client;
    }

    /**
     * Converts text to speech
     *
     * @param string $text
     * @param array $options
     * @return null|\GuzzleHttp\Psr7\Stream|\Aws\Result
     */
    public function convertToSpeech(string $text, array $options)
    {
        $parameters = array_merge($options, ['Text' => $text]);
        return $this->client->synthesizeSpeech($parameters);
    }
}
