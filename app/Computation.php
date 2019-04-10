<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computation extends Model
{
    protected $fillable = [
        'classes_subject_id',
        'name',
        'description',
        'value',
        'period'
    ];
}
