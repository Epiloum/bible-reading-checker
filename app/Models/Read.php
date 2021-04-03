<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Read extends Model
{
    use SoftDeletes;

    protected $fillable = ['chapter_id', 'user_id'];

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
