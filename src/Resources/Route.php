<?php

namespace WebMerge\Resources;

use WebMerge\Exceptions\Exception;

class Route extends ResourceBase
{
    /**
     * {@inheritdoc}
     */
    protected function register()
    {
        return [
            'name' => 'routes'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options = [])
    {
        throw new Exception(
            'Currently not available, API coming soon!'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update(array $options = [])
    {
        throw new Exception(
            'Currently not available, API coming soon!'
        );
    }
}
