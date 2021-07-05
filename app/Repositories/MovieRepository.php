<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;

/**
 * Class MovieRepository
 * @package App\Repositories
 */
class MovieRepository implements MovieRepositoryInterface
{

    /**
     * @param integer $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return Movie::findOrFail($id, $columns);
    }

    /**
     * @param integer $perPage
     * @param string $title
     * @param array $columns
     * @return mixed
     */
    public function getMoviesBySearchWithPaginate($perPage, $title, $columns = ['*'])
    {
        return Movie::where('title', 'like', '%' . $title . '%')
            ->select($columns)
            ->paginate($perPage);
    }

    /**
     * @param integer $perPage
     * @param array $columns
     * @return mixed
     */
    public function getMoviesLatestWithPaginate($perPage, $columns = ['*'])
    {
        return Movie::latest()
            ->select($columns)
            ->paginate($perPage);
    }
}
