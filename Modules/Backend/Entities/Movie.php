<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends =['thumb_url'];

    public function getThumbUrlAttribute()
    {
        if (!isset($this->thumbnail) && $this->thumbnail == '') {
            return null;
        }
        return asset(Storage::url('public/thumbnail/' .$this->thumbnail));
    }

    public function LinkMovies()
    {
      return $this->hasMany(LinkMovie::class);
    }

    public function tags()
    {
      return $this->hasOne(Tag::class,'movie_id');
    }

    public function keywords()
    {
      return $this->hasOne(Keyword::class,'movie_id');
    }
}
