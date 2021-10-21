<?php

namespace de\xovatec\linkify\Controllers;

use Laravel\Lumen\Application;
use Laravel\Lumen\Exceptions\NotFoundException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Laravel\Lumen\Routing\Controller;

class UsersController extends Controller
{
    protected Application $app;

    protected JsonResponse $response;

    protected Collection $data;

    /**
     * UsersController constructor.
     * @param Application $app
     * @param Filesystem $filesystem
     * @param JsonResponse $response
     * @throws FileNotFoundException
     */
    public function __construct(Application $app, Filesystem $filesystem, JsonResponse $response)
    {
        $this->app = $app;
        $this->response = $response;

        $users = $filesystem->get(
            $this->app->storagePath('app/mockdata.json')
        );

        $this->data = new Collection(
            \json_decode($users)
        );
        
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = \max(1, $request->query->getInt('page', 1));
        $limit = \min($request->query->getInt('limit', 10), 100);
           
        $paginator = new LengthAwarePaginator(
            $this->data->forPage($page, $limit)->values(),
            $this->data->count(),
            $limit,
            $page,
            [
                'path' => $request->getRequestUri()
            ]
        );

        return $this->response->setData($paginator);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function details(int $id): JsonResponse
    {
        $item = $this->data->firstWhere('id', $id);

        if ($item === null) {
            throw new NotFoundException();
        }

        return $this->response->setData($item);
    }

    /**
     * This will not create a new resource - it will just simulate creation.
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        return $this->response->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * This will not update a resource - it will just simulate one.
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function update(int $id): JsonResponse
    {
        $this->details($id);

        return $this->response->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    /**
     * This will not delete a resource - it will just simulate one.
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function delete(int $id): JsonResponse
    {
        $this->details($id);

        return $this->response->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
