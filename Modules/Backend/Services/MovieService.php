<?php

namespace Modules\Backend\Services;

use App\Helpers\ClientResponderHelper;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Movie;
use Illuminate\Support\Str;
use Modules\Backend\Entities\LinkMovie;

class MovieService {
  use ClientResponderHelper;

  // Insert Movie
  public function InsertMovie($params)
  {
    try {
      DB::beginTransaction();

      $link = $params['link'];

      $img = $params['thumbnail'];
      $thumbnail      = time(). random_int(10000, 99999) .".".$img->getClientOriginalExtension();
      $tujuan_upload  = 'public/thumbnail';
      $img->storeAs($tujuan_upload,$thumbnail);

      $movie = Movie::create([
        'title'         => $params['title'],
        'slug'          => Str::slug($params['title']),
        'thumbnail'     => $thumbnail,
        'description'   => $params['description'],
        'genre'         => $params['genre'],
        'adult'         => $params['adult'],
        'release_date'  => $params['release_date'],
        'url_trailer'   => $params['url_trailer'],
        'created_by'    => Auth::id()
      ]);

      foreach ($link as $links) {
        LinkMovie::create([
          'movie_id'    => $movie->id,
          'url_movie'   => $links['url_movie'],
          'is_active'   => TRUE,
          'created_by'  => Auth::id()
        ]);
      }

      DB::commit();
      return $this->responseSuccess(200, 'success', $movie);
    } catch (\Exception $e) {
       return $this->responseFailed($e->getMessage());
    }
  }

  // List Movie
  public function ListMovie($params)
  {
    try {
      $search = $params['search'] ?? null;

      $list = Movie::with(['LinkMovies'])->where('title', 'LIKE',"%{$search}%")->paginate(10);
      return $this->responseSuccess(200,'success', $list);
    } catch (\Exception $e) {
      return $this->responseFailed($e->getMessage());
    }
  }

  // Update Movie
  public function UpdateMovie($params)
  {
    try {
      DB::beginTransaction();
      $link = $params['link'];
      $id = $params['movie_id'];

      if ($params['thumbnail']) {
        $img = $params['thumbnail'];
        $thumbnail      = time(). random_int(10000, 99999) .".".$img->getClientOriginalExtension();
        $tujuan_upload  = 'public/thumbnail';
        $img->storeAs($tujuan_upload,$thumbnail);
      }

      $movie = Movie::whereId($id)->first();
      if(!$movie) throw new Exception("Movie Not Found.");
       $movie->title        = $params['title'] ?? $movie->title;
       $movie->thumbnail    = $thumbnail ?? $movie->thumbnail;
       $movie->description  = $params['description'] ?? $movie->description;
       $movie->genre        = $params['genre'] ?? $movie->genre;
       $movie->adult        = $params['adult'] ?? $movie->adult;
       $movie->release_date = $params['release_date'] ?? $movie->release_date;
       $movie->url_trailer  = $params['url_trailer'] ?? $movie->url_trailer;
       $movie->updated_by   = Auth::id();
       $movie->update();

      foreach ($link as $key => $links) {
        $link = LinkMovie::firstOrNew([
          'id' => $links['id'] ?? $key++
        ]);
        $link->movie_id    = $id;
        $link->url_movie   = $links['url_movie'];
        $link->is_active   = $links['is_active'] ?? $link->is_active;
        $link->updated_by  = Auth::id();
        $link->update();
      }
      DB::commit();
      return $this->responseSuccess(200,'success', $movie);
    } catch (\Exception $e) {
      return $this->responseFailed($e->getMessage());
    }
  }
}