<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Requests\MovieRequest;
use Modules\Backend\Services\MovieService;

class BackendController extends Controller
{
    public function __construct(MovieService $service)
    {
      $this->service = $service;
    }

    public function InsertMovieService(MovieRequest $request)
    {
      return $this->service->InsertMovie($request->all());
    }

    public function ListMovieService(Request $request)
    {
      return $this->service->ListMovie($request);
    }

    public function UpdateMovieService(Request $request)
    {
      return $this->service->UpdateMovie($request->all());
    }
}
