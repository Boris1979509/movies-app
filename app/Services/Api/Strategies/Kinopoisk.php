<?php

namespace App\Services\Api\Resources;

use App\Models\Movie;
use App\Services\Api\ApiStrategy;
use App\Services\Api\BaseData;
use Exception;
use Illuminate\Support\Facades\Http;

/**
 * Class Kinopoisk
 * @package App\Services\Api\Resources
 */
class Kinopoisk extends BaseData
{
    /**
     * @return mixed
     * @return ApiStrategy
     * @throws Exception
     */
    public function getData()
    {
        $token = env('MOVIE_APP_TOKEN');
        $url = env('MOVIE_APP_URL');
        $i = 1;
        while ($i <= 10) {
            $response = Http::acceptJson()->get($url . '/all/page/' . random_int(1, 1000) . '/token/' . $token);
            $this->data = json_decode($response, true);
            $i++;
        }
        return $this;
    }

    /**
     * @return void
     */
    public function saveData()
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
