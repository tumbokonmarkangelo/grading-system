<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class Grade extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'classes_subject_id',
        'student_id',
        'computed_grade'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];

    public function items()
    {
        return $this->hasMany('App\GradesItem', 'grade_id');
    }
}
