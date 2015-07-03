<?php

namespace WebMerge\Responses;

class JSONData {

    private $contents;

    public function __construct($contents)
    {
        $this->contents = $contents;
    }

    /**
     * Return response contents as an array.
     *
     * @return array
     *   An array of the response contents.
     */
    public function asArray()
    {
        return $this->contents ? json_decode($this->contents) : [];
    }

}
