<?php

namespace App\Services\Api;

/**
 * Class BaseData
 * @package App\Services\Api
 */
abstract class BaseData implements ApiStrategy
{
    /**
     * @var array $data
     */
    protected $data;

    /**
     * BaseData constructor.
     */
    final public function __construct()
    {
    }
}
