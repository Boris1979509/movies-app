<?php

namespace App\Services\Api\Strategies;

use App\Models\Movie;
use App\Services\Api\ApiStrategyInterface;
use App\Services\Api\BaseData;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class File
 * @package App\Services\Api\Strategies
 */
class File //extends BaseData
{
    /**
     * @var array $data
     */
    private $data;

    /**
     * @return mixed
     * @return ApiStrategyInterface
     * @throws FileNotFoundException
     */
    public function getData()
    {
        $contents = Storage::disk('movies')->get('movies.json');
        $this->data = json_decode($contents, true);
        return $this;
    }

    /**
     * @return void
     */
    public function saveData()
    {
        echo 'File saved.';
    }
}
