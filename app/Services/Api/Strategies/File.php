<?php

namespace App\Services\Api\Strategies;

use App\Models\Movie;
use App\Services\Api\BaseData;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class File
 * @package App\Services\Api\Strategies
 */
class File extends BaseData
{

    /**
     * @return $this|mixed
     * @throws FileNotFoundException
     */
    public function request()
    {
        $contents = Storage::disk('movies')->get('movies.json');
        $this->data = json_decode($contents, true);
        return $this;
    }

    /**
     * @return void
     */
    public function handle()
    {
        foreach ($this->data['movies'] as $key => $value) {
            Movie::updateOrCreate(['id_kinopoisk' => $value['id_kinopoisk']], [
                'id_kinopoisk'      => $value['id_kinopoisk'],
                'url'               => $value['url'],
                'type'              => $value['type'],
                'title'             => $value['title'],
                'title_alternative' => $value['title_alternative'],
                'tagline'           => $value['tagline'],
                'description'       => $value['description'],
                'year'              => $value['year'],
                'poster'            => $value['poster'],
                'trailer'           => $value['trailer'],
                'age'               => $value['age'],
                'actors'            => $value['actors'],
                'countries'         => $value['countries'],
                'genres'            => $value['genres'],
                'premiere_world'    => $value['premiere_world'],
                'rating_kinopoisk'  => $value['rating_kinopoisk'],
                'rating_imdb'       => $value['rating_imdb'],
            ]);
        }
    }
}
