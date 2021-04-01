<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function reads()
    {
        return $this->hasMany('App\Models\Read');
    }
}
