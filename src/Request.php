<?php

namespace WebMerge;

class Request
{
    /**
     * Guzzle client object
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     *  Allowed request methods.
     */
    private $methods = [
        'get',
        'put',
        'post',
        'patch',
        'delete',
    ];

    /**
     * Request constructor.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Make the REST API call to the service endpoint.
     *
     * @param string $method Method to execute.
     * @param array $args    An array of arguments to pass to the method.
     *
     * @throws \WebMerge\Exceptions\Exception
     * @throws \WebMerge\Exceptions\InvalidArgumentException
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function call($method, array $args = [])
    {
        $method = strtolower($method);
        if (!in_array($method, $this->methods)) {
            throw new \WebMerge\Exceptions\InvalidArgumentException(
                'The provided method is not valid.'
            );
        }
        $response = null;

        try {
            $response = call_user_func_array(
                [$this->client, $method], $args
            );
        } catch (\Exception $e) {
            throw new \WebMerge\Exceptions\Exception(
                $e->getMessage()
            );
        }

        return $response;
    }
}
