<?php

namespace App\Services\Api;

/**
 * Class ContextStrategy
 * @package App\Services\Api
 */
class ContextStrategy
{
    /**
     * @var ApiStrategyInterface $instance
     */
    private $instance;

    /**
     * ContextStrategy constructor.
     * @param ApiStrategyInterface $instance
     */
    public function __construct(ApiStrategyInterface $instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $this->instance->request()->handle();
    }

}
