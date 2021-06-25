<?php

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    return view('app');
});

Route::get('api', static function () {
    $token = '0c4cd3f9942c9c9d58ea3135a159ccf9';
    $url = 'https://api.kinopoisk.cloud/movies/all/page/2';
    try {
        $response =  Http::acceptJson()->get($url . '/token/' . $token);
        $clients = json_decode($response, true);
        dd($clients);
        //$response->movies;
    } catch (ConnectionException $error) {
        exit($error->getMessage());
    }
});
