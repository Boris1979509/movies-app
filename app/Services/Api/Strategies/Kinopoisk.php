<?php

namespace App\Services\Api\Strategies;

use App\Models\Movie;
use App\Services\Api\ApiStrategyInterface;
use App\Services\Api\BaseData;
use Exception;
use Illuminate\Support\Facades\Http;

/**
 * Class Kinopoisk
 * @package App\Services\Api\Strategies
 */
class Kinopoisk extends BaseData
{

    const ITER = 10;

    /**
     * @return ApiStrategyInterface
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
            ]);
        }
    }
}
