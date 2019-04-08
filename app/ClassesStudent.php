<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class ClassesStudent extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'class_id',
        'student_id',
        'code',
        'semester_id',
        'year_id'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];
}