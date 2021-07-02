<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class MovieController
 * @package App\Http\Controllers
 */
class MovieController extends Controller
{
    /**
     * Paginate
     */
    const LIMIT_PER_PAGE = 8;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(
            Movie::latest()->paginate(self::LIMIT_PER_PAGE)); // order results by date
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $movie = Movie::find($id);
            $movie->delete();
            $message = ['message' => __('messages.successfully deleted', ['title' => '"' . $movie->title . '"'])];
            return response()->json($message);
        } catch (\Exception $error) {
            exit($error->getMessage());
        }
    }
}
