<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeywordSeries extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'name' => 'array'
    ];
}
