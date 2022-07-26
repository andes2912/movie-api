<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Frontend\Services\FrontendService;

class FrontendController extends Controller
{
    protected $service;

    public function __construct(FrontendService $service)
    {
        $this->service = $service;
    }

    public function DiscoverService()
    {
        return $this->service->Discover();
    }

    public function LatestService()
    {
       return $this->service->Latest();
    }

    public function DetailService(Request $request)
    {
        return $this->service->Detail($request);
    }
}
