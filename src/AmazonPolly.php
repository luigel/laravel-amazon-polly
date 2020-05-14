<?php

namespace Luigel\AmazonPolly;

use League\Flysystem\FileNotFoundException;

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
     * 'Engine' => 'standard|neural',
     * 'LanguageCode' => 'arb|cmn-CN|cy-GB|da-DK|de-DE|en-AU|en-GB|en-GB-WLS|en-IN|en-US|es-ES|es-MX|es-US|fr-CA|fr-FR|is-IS|it-IT|ja-JP|hi-IN|ko-KR|nb-NO|nl-NL|pl-PL|pt-BR|pt-PT|ro-RO|ru-RU|sv-SE|tr-TR',
     *'LexiconNames' => ['<string>', ...],
     *'OutputFormat' => 'json|mp3|ogg_vorbis|pcm', // REQUIRED
     *'SampleRate' => '<string>',
     *'SpeechMarkTypes' => ['<string>', ...],
     *'Text' => '<string>', // REQUIRED
     *'TextType' => 'ssml|text',
     *'VoiceId' => 'Aditi|Amy|Astrid|Bianca|Brian|Camila|Carla|Carmen|Celine|Chantal|
      *Conchita|Cristiano|Dora|Emma|Enrique|Ewa|Filiz|Geraint|Giorgio|Gwyneth|Hans|Ines|Ivy|Jacek|
      *Jan|Joanna|Joey|Justin|Karl|Kendra|Kimberly|Lea|Liv|Lotte|Lucia|Lupe|Mads|Maja|Marlene|
      *Mathieu|Matthew|Maxim|Mia|Miguel|Mizuki|Naja|Nicole|Penelope|Raveena|Ricardo|Ruben|Russell|Salli|
      *Seoyeon|Takumi|Tatyana|Vicki|Vitoria|Zeina|Zhiyu', // REQUIRED
     * 
     * 
     * @param string $text
     * @param array $options
     * @return null|\GuzzleHttp\Psr7\Stream|\Aws\Result
     */
    public function convertTextToSpeech(string $text, array $options)
    {
        if (!isset($options['VoiceId']))
        {
            $options['VoiceId'] = config('amazon-polly.default_voice_id');
        }
        
        $parameters = array_merge($options, ['Text' => $text]);
        return $this->client->synthesizeSpeech($parameters);
    }

    /**
     * Converts file to speech
     *
     * @param string $path
     * @param array $options
     * @return null|\GuzzleHttp\Psr7\Stream|\Aws\Result
     * 
     * @throws FileNotFoundException
     */
    public function convertFileToSpeech(string $path, array $options)
    {
        if (!file_exists($path))
        {
            throw new FileNotFoundException($path);
        }

        $text = file_get_contents($path);
        
        return $this->convertTextToSpeech($text, $options);
    }

}
