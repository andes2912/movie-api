<?php

namespace Modules\Frontend\Services;

use App\Helpers\ClientResponderHelper;
use Exception;
use Modules\Backend\Entities\Movie;

class FrontendService {
    use ClientResponderHelper;

    // Discover Movie
    public function Discover()
    {
        try {
            $discover = Movie::paginate(10);
            return $this->responseSuccess(200,'success', $discover);
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    // Latest Movie
    public function Latest()
    {
        try {
            $latest = Movie::orderBy('created_at','desc')->paginate(10);
            return $this->responseSuccess(200,'success', $latest);
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    // Detail Movie
    public function Detail($params)
    {
        try {
            $slug = $params['slug'];
            $detail = Movie::where('slug', $slug)->first();
            if(!$detail) throw new Exception("Movie Not Found.");
            $detail->increment('count');
            return $this->responseSuccess(200,'success', $detail);
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }
}
