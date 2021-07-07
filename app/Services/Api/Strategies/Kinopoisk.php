<?php

namespace App\Services\Api\Strategies;

use App\Models\Movie;
use App\Services\Api\BaseData;
use Exception;
use Illuminate\Support\Facades\Http;

/**
 * Class Kinopoisk
 * @package App\Services\Api\Strategies
 */
class Kinopoisk extends BaseData
{

    const ITER = 5;

    /**
     * @return $this|mixed
     * @throws Exception
     */
    public function request()
    {
        $token = env('MOVIE_APP_TOKEN');
        $url = env('MOVIE_APP_URL');
        $i = 1;
        while ($i <= self::ITER) {
            $response = Http::acceptJson()->get($url . '/all/page/' . random_int(1, 1000) . '/token/' . $token);
            $this->data = json_decode($response, true);
            $i++;
        }
        return $this;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        if ($this->data['error']) { // limit requests
            throw new \RuntimeException(__('messages.' . $this->data['error']['message']));
        }
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
