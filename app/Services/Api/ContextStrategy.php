<?php

namespace App\Services\Api;

/**
 * Class Context
 * @package App\Services\Api
 */
class Context
{
    /**
     * @var ApiStrategy $instance
     */
    private $instance;

    /**
     * Context constructor.
     * @param ApiStrategy $instance
     */
    public function __construct(ApiStrategy $instance)
    {
        $this->instance = $instance;
    }

    public function execute()
    {
        $this->instance->getData()->saveData();
    }

}
