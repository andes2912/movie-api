<?php

namespace Modules\Backend\Services;

use App\Helpers\ClientResponderHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Series;
use Illuminate\Support\Str;
use Modules\Backend\Entities\KeywordSeries;
use Modules\Backend\Entities\LinkSeries;
use Modules\Backend\Entities\SeriesMovie;
use Modules\Backend\Entities\TagSeries;

class SeriesService {
    use ClientResponderHelper;

    // Insert Series
    public function insert($params)
    {
        try {
            DB::beginTransaction();
            $link = $params['link'];

            $img = $params['thumbnail'];
            $thumbnail      = time(). random_int(10000, 99999) .".".$img->getClientOriginalExtension();
            $tujuan_upload  = 'public/series/thumbnail';
            $img->storeAs($tujuan_upload,$thumbnail);

            $series = Series::create([
                'title'         => $params['title'],
                'slug'          => Str::slug($params['title']),
                'thumbnail'     => $thumbnail,
                'description'   => $params['description'],
                'adult'         => $params['adult'],
                'country'       => $params['country'],
                'release_date'  => $params['release_date'],
                'genre'         => implode(',',$params['genre']),
                'url_trailer'   => $params['url_trailer'],
                'status'        => $params['status'],
                'created_by'    => Auth::id()
            ]);

            // Create Season & Episode
            $seriesMovie = SeriesMovie::create([
                'series_id'     => $series->id,
                'season'        => $params['season'],
                'episode'       => $params['episode'],
                'count'         => 0,
                'created_by'    => Auth::id()
            ]);

            // Create Link Series
            foreach ($link as $key => $links) {
                $link = LinkSeries::create([
                    'series_movie_id'   => $seriesMovie->id,
                    'url_series'        => $links['url_series'],
                    'is_active'         => TRUE,
                    'created_by'        => Auth::id()
                ]);
            }

            // Create Tag
            TagSeries::create([
                'series_movie_id'   => $seriesMovie->id,
                'name'              => $params['name_tag']
            ]);

            // Create Keyword
            KeywordSeries::create([
                'series_movie_id'   => $seriesMovie->id,
                'name'              => $params['name_keyword']
            ]);

            DB::commit();
            return $this->responseSuccess(200, 'success', $series);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseFailed($e->getMessage());
        }
    }
}
