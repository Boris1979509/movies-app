<?php

namespace App\Services\Api;

/**
 * Interface ApiStrategyInterface
 * @package App\Services\Api
 */
interface ApiStrategyInterface
{
    /**
     * @return mixed
     * @return ApiStrategyInterface
     */
    public function request();

    /**
     * @return void
     */
    public function handle();

}
