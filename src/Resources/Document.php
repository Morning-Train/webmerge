<?php

namespace WebMerge\Resources;

class Document extends ResourceBase
{
    /**
     * {@inheritdoc}
     */
    protected function register()
    {
        return [
            'name' => 'documents'
        ];
    }
}
