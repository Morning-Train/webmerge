<?php

namespace WebMerge;

class ResponseData {

    /**
     * Guzzle response object.
     *
     * @var \GuzzleHttp\Psr7\Response
     */
    private $response;

    /**
     * Response constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the response body contents.
     *
     * @return string
     *   The original body contents.
     */
    public function contents()
    {
        $body = $this->response->getBody();

        if (!$body) {
            return null;
        }

        return $body->getContents();
    }

    /**
     * Extract response contents into a particular format.
     *
     * @return mixed Response data object based on the contents type or contents.
     */
    public function extract()
    {
        $contents = $this->contents();

        switch ($this->type()) {
            case 'application/pdf':
                return new \WebMerge\Responses\PDFData($contents);

            case 'application/json':
                return new \WebMerge\Responses\JSONData($contents);
        }

        return $contents;
    }

    /**
     * Response contents type.
     *
     * @return string The response header content type.
     */
    protected function type()
    {
        $type = $this->response->getHeader(
            'Content-Type'
        );

        return strtolower(reset($type));
    }
}
