<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchResult extends Model
{
    protected $fillable = ['term', 'count', 'time'];
    public $timestamps = false;
}
