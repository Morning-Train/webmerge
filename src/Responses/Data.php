<?php

namespace WebMerge\Responses;

abstract class Data {

    /**
     * Response contents.
     *
     * @var string
     */
    protected $contents;

    /**
     * Construct data object.
     *
     * @param string $contents Response body contents.
     */
    public function __construct($contents)
    {
        $this->contents = $contents;
    }

    /**
     * Retrieve the response contents.
     *
     * @return string The message body contents.
     */
    public function getContents()
    {
        return $this->contents;
    }
}
