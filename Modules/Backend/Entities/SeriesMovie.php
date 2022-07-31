<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeriesMovie extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function linkSeries()
    {
        return $this->hasMany(LinkSeries::class);
    }

    public function tagSeries()
    {
       return $this->hasOne(TagSeries::class);
    }

    public function keywordSeries()
    {
        return $this->hasOne(keywordSeries::class);
    }
}
