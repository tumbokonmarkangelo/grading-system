<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];
    
    public function activities()
    {
        return $this->morphMany('App\Activity', 'loggable');
    }
}