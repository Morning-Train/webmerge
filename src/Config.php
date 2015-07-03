<?php

namespace WebMerge;

class Config
{
    /**
     * API key.
     *
     * @var string
     */
    private $key;

    /**
     * API secret.
     *
     * @var string
     */
    private $secret;

    /**
     * API endpoint.
     */
    const API_ENDPOINT = 'https://www.webmerge.me/api/';

    /**
     * Construct configuration object.
     *
     * @param string $key    The API key string.
     * @param string $secret The API secret string.
     */
    public function __construct($key, $secret)
    {
        $this->key    = $key;
        $this->secret = $secret;
    }

    /**
     * Retrieve a base64 encoded of the API key.
     *
     * @return string
     *   A base64 encoded API key.
     */
    public function getAPIKey()
    {
        return base64_encode($this->key . ':' . $this->secret);
    }
}
