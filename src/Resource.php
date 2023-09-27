<?php

namespace WebMerge;

class Resource
{
    /**
     * Resource classname.
     *
     * @var string
     */
    private $class;

    /**
     * Configuration object.
     *
     * @var \WebMerge\Config
     */
    private $config;

    /**
     * Resource construct.
     *
     * @param \WebMerge\Config $config A configuration object.
     * @param string           $class  Resource class name.
     */
    public function __construct($config, $class)
    {
        $this->class  = $class;
        $this->config = $config;
    }

    /**
     * Callable method.
     *
     * @param string $identifier A unique identifier.
     * @param string $folder A folder name.
     *
     * @throws \WebMerge\Exceptions\Exception
     * @throws \WebMerge\Exceptions\InvalidArgumentException
     *
     * @return \WebMerge\Response
     */
    public function __invoke($identifier = null, $folder = '')
    {
        if (!class_exists($this->class)) {
            throw new \WebMerge\Exceptions\InvalidArgumentException(
                'Resource ' . $this->class . ' was not found.'
            );
        }
        $config = $this->config;

        $response = null;
        try {
            $response = new $this->class(new \WebMerge\Request(
                new \GuzzleHttp\Client([
                    'base_uri' => $config::API_ENDPOINT,
                    'headers' => [
                        'Content-Type'  => 'application/json',
                        'Authorization' => 'Basic ' . $config->getAPIKey()
                    ],
                    'query' => [
                        'folder' => $folder
                    ]
                ])
            ), $identifier);
        } catch (\Exception $e) {
            throw new \WebMerge\Exceptions\Exception(
                $e->getMessage()
            );
        }

        return $response;
    }
}
