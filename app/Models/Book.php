<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter');
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }
}
