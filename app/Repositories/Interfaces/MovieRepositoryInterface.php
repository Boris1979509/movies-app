<?php

namespace App\Repositories\Interfaces;

/**
 * Interface MovieRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface MovieRepositoryInterface
{
    /**
     * @param integer $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param integer $perPage
     * @param string $title
     * @param array $columns
     * @return mixed
     */
    public function getMoviesBySearchWithPaginate($perPage, $title, $columns = ['*']);

    /**
     * @param integer $perPage
     * @param array $columns
     * @return mixed
     */
    public function getMoviesLatestWithPaginate($perPage, $columns = ['*']);
}
