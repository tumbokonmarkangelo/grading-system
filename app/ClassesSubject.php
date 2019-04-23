<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class ClassesSubject extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'code',
        'semester_id',
        'year_id',
        'prelim',
        'midterm',
        'final'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];
    
    public function subject()
	{
		return $this->hasOne('App\Subject', 'id', 'subject_id');
	}
    
    public function teacher()
	{
		return $this->hasOne('App\User', 'id', 'teacher_id');
	}

    public function computations()
    {
        return $this->hasMany('App\Computation', 'classes_subject_id');
    }
    
    public function class()
	{
		return $this->hasOne('App\Classes', 'id', 'class_id');
	}

    public function grades()
    {
        return $this->hasMany('App\Grade', 'classes_subject_id');
    }
    
    public function activities()
    {
        return $this->morphMany('App\Activity', 'loggable');
    }
}