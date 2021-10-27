<?php

namespace de\xovatec\linkify\Controllers;

use de\xovatec\linkify\Services\LinkService;
use Exception;
use Laravel\Lumen\Routing\Controller;

class LinkController extends Controller
{
    /**
     * 
     * @var LinkService
     */
    private $linkService;
    
    protected $response;

    public function __construct(LinkService $linkService)
    {
       $this->linkService = $linkService;
       $this->response = new \Illuminate\Http\JsonResponse();
    }
    
    public function list(): \Illuminate\Http\JsonResponse
    {
        return $this->response->setContent($this->linkService->getList());
    }
    
    public function add()
    {
        
    }
    
    public function markAsRead()
    {
        
    }
}
