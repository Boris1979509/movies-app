<?php

namespace App\Services\Api;

/**
 * Interface ApiStrategy
 * @package App\Services\Api
 */
interface ApiStrategy
{
    /**
     * @return mixed
     * @return ApiStrategy
     */
    public function getData();

    /**
     * @return void
     */
    public function saveData();

}
