<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * Class MoviesUpdate
 * @package App\Console\Commands
 */
class MoviesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @return void
     */
    public function handle()
    {
        //$contents = Storage::disk('movies')->get('movies.json');
        //$data = json_decode($contents, true);
        $token = env('MOVIE_APP_TOKEN');
        $url = env('MOVIE_APP_URL');
        try {

            $i = 1;
            while ($i <= 10) {
                $response = Http::acceptJson()->get($url . '/all/page/' . random_int(1, 1000) . '/token/' . $token);
                $data = json_decode($response, true);
                $this->insertDb($data);
                $i++;
            }
            $this->info('The command was successful!');

        } catch (\Exception $error) {
            exit($error->getMessage());
        }
    }

    /**
     * @param array $data
     * @return void
     */
    private function insertDb($data)
    {
        foreach ($data['movies'] as $key => $value) {
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
