<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class Classes extends Model
{
    use SoftDeletes;
    
    protected $table = 'classes';
    
    protected $fillable = [
        'code',
        'semester_id',
        'year_id'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];
}