<?php

namespace WebMerge;

class Merge
{
    /**
     * Resource ID.
     *
     * @var integer
     */
    private $id;

    /**
     * Resource key.
     *
     * @var string
     */
    private $key;

    /**
     * Download flag.
     *
     * @var boolean
     */
    private $download;

    /**
     * Debug test flag.
     *
     * @var boolean
     */
    private $test = false;

    /**
     * Merge API endpoint.
     */
    const API_ENDPOINT = "https://www.webmerge.me/merge/";

    /**
     * Merge constructor.
     */
    public function __construct($id, $key, $download = false, $test = true)
    {
        $this->id       = $id;
        $this->key      = $key;
        $this->test     = $test;
        $this->download = $download;
    }

    /**
     * Merge field data into resource.
     *
     * @param array $values An array of the data to merge into the resource.
     *
     * @throws \WebMerge\Exceptions\Exception
     *
     * @return \WebMerge\ResponseData
     */
    public function fields(\Closure $values) {
        $client = new \GuzzleHttp\Client(
            [
                'base_uri' => self::API_ENDPOINT,
                'query' => array_filter(
                    [
                        'test'     => $this->test,
                        'download' => $this->download,
                    ]
                )
            ]
        );
        $merge_path = $this->id . '/' . $this->key;

        $response = null;
        try {
            $response = $client->post($merge_path,
                [
                    'json' => $values(),
                ]
            );
        } catch (\Exception $e) {
            throw new \WebMerge\Exceptions\Exception(
                $e->getMessage()
            );
        }

        return new \WebMerge\ResponseData($response);
    }
}
