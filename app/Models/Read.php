<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}