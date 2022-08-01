<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Requests\MovieRequest;
use Modules\Backend\Http\Requests\SeasonSeriesRequest;
use Modules\Backend\Http\Requests\SeriesRequest;
use Modules\Backend\Services\MovieService;
use Modules\Backend\Services\SeriesService;

class BackendController extends Controller
{
    protected $ServiceMovie, $ServiceSeries;

    public function __construct(MovieService $ServiceMovie, SeriesService $ServiceSeries)
    {
      $this->ServiceMovie = $ServiceMovie;
      $this->ServiceSeries = $ServiceSeries;
    }

    // Create Movie
    public function InsertMovieService(MovieRequest $request)
    {
      return $this->ServiceMovie->InsertMovie($request->all());
    }

    // List Movie
    public function ListMovieService(Request $request)
    {
      return $this->ServiceMovie->ListMovie($request);
    }

    // Update Movie
    public function UpdateMovieService(Request $request)
    {
      return $this->ServiceMovie->UpdateMovie($request->all());
    }

    // Create Series
    public function CreateSeriesService(SeriesRequest $request)
    {
        return $this->ServiceSeries->insert($request);
    }

    // List Series
    public function ListSeriesService(Request $request)
    {
        return $this->ServiceSeries->list($request);
    }

    // Detail Series
    public function DetailSeriesService(Request $request)
    {
        return $this->ServiceSeries->detail($request);
    }

    // Create season & episode series
    public function CreateSeasonSeriesService(SeasonSeriesRequest $request)
    {
        return $this->ServiceSeries->createSeries($request);
    }
}
