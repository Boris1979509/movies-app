<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MovieRepository;
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
     * @var MovieRepository $repository
     */
    private $repository;

    /**
     * MovieController constructor.
     * @param MovieRepository $repository
     */
    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $columns = [
            'id',
            'title',
            'poster',
            'year',
            'url',
            'description',
            'genres',
            'actors',
            'countries'
        ];
        if ($title = $request->get('search')) {
            $paginator = $this->repository
                ->getMoviesBySearchWithPaginate(
                    self::LIMIT_PER_PAGE,
                    $title, $columns
                );
//                ->withPath('?' . $request->getQueryString());
        } else {
            $paginator = $this->repository
                ->getMoviesLatestWithPaginate(self::LIMIT_PER_PAGE,
                    $columns);
        }

        return response()->json($paginator); // order results by date
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
            $movie = $this->repository->find($id, ['id', 'title', 'poster', 'year', 'url']);
            $movie->delete();
            $message = ['message' => __('messages.successfully deleted', ['title' => '"' . $movie->title . '"'])];
            return response()->json($message);
        } catch (\Exception $error) {
            exit($error->getMessage());
        }
    }
}
