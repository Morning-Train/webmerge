<?php

namespace WebMerge\Resources;

use WebMerge\ResponseData;

abstract class ResourceBase
{
    /**
     * Request unique identifier.
     *
     * @var string
     */
    private $id;

    /**
     * Request object.
     *
     * @var \WebMerge\Request
     */
    private $request;

    /**
     * Resource constructor.
     *
     * @param \WebMerge\Request $client Request object
     * @param integer           $id     Resource unique identifier.
     */
    public function __construct(\WebMerge\Request $request, $id)
    {
        $this->id      = $id;
        $this->request = $request;
    }

    /**
     * Get a list of resources.
     *
     * @param array $query
     *
     * @return \WebMerge\Response
     */
    public function pull(array $query = [])
    {
        $response = $this->request->call(
            'GET', [$this->params(), ['query' => $query]]
        );

        return new ResponseData($response);
    }

    /**
     * Get a list of resources.
     *
     * @return \WebMerge\Response
     */
    public function list()
    {
        $response = $this->request->call(
            'GET', [$this->params()]
        );

        return new ResponseData($response);
    }

    /**
     * Get a single resource.
     *
     * @return \WebMerge\Response
     */
    public function get()
    {
        $response = $this->validate()->request->call(
            'GET', [$this->params([$this->id])]
        );

        return new ResponseData($response);
    }

    /**
     * Create a resource.
     *
     * @param \Closure $values An array of values to save.
     *
     * @return \WebMerge\Response
     */
    public function create(\Closure $values)
    {
        $response = $this->request->call(
            'POST', [
                $this->params(), ['json' => $values()]
            ]
        );

        return new ResponseData($response);
    }

    /**
     * Update a resource.
     *
     * @param \Closure $values An array of values to update.
     *
     * @return \WebMerge\Response
     */
    public function update(\Closure $values)
    {
        $response = $this->validate()->request->call(
            'PUT', [
                $this->params([$this->id]), ['json' => $values()]
            ]
        );

        return new ResponseData($response);
    }

    /**
     * Delete a single resource by ID.
     *
     * @param integer $this->id
     *
     * @return \WebMerge\Response
     */
    public function delete()
    {
        $response = $this->validate()->request->call(
            'DELETE', [
                $this->params([$this->id])
            ]
        );

        return new ResponseData($response);
    }

    /**
     * Get a resource fields by ID.
     *
     * @param integer $this->id
     *
     * @return \WebMerge\Response
     */
    public function fields()
    {
        $response = $this->validate()->request->call(
            'GET', [
                $this->params([$this->id, 'fields'])
            ]
        );

        return new ResponseData($response);
    }

    /**
     * Validate the required variables are available.
     *
     * @throws \Exception
     */
    protected function validate()
    {
        if (!$this->id) {
            throw new \Exception(
                'A unique identifier is required.'
            );
        }

        return $this;
    }

    /**
     * Retrieve the resource URI parameters.
     *
     * @param array $params An array of parameters to append.
     *
     * @return string
     *   The URI of the resource.
     */
    protected function params(array $params = [])
    {
        return implode('/', array_merge(
            [$this->name()], $params)
        );
    }

    /**
     * Retrieve the resource registered name.
     *
     * @return string
     *   The name of the resource.
     */
    protected function name()
    {
        $register = $this->register();

        if (!isset($register['name'])) {
            throw new Exception('Resource needs to register a name.');
        }

        return $register['name'];
    }

    /**
     * Register the resource.
     *
     * @return array
     *   An array defining the resource.
     */
    abstract protected function register();
}
