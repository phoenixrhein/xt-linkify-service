<?php

namespace de\xovatec\linkify\Controllers;

use de\xovatec\linkify\Services\LinkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

/**
 * class LinkController
 */
class LinkController extends Controller
{

    /**
     * 
     * @var LinkService
     */
    private LinkService $linkService;

    /**
     * 
     * @var JsonResponse
     */
    protected JsonResponse $response;

    /**
     * LinkController constructor
     * 
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
        $this->response = new JsonResponse();
    }

    /**
     * Link list
     * 
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->response->setContent($this->linkService->getList());
    }

    /**
     * Add new link
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        return $this->response->setContent($this->linkService->add($request->post('link')));
    }

    /**
     * Mark link as read
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function markAsRead(int $id): JsonResponse
    {
        return $this->response->setContent($this->linkService->markAsRead($id));
    }

}
