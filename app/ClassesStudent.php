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
        'status',
        'code',
        'semester_id',
        'year_id'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];
    
    public function student()
	{
		return $this->hasOne('App\User', 'id', 'student_id');
	}
    
    public function class()
	{
		return $this->hasOne('App\Classes', 'id', 'class_id');
	}

    public function grades()
    {
        return $this->hasMany('App\Grade', 'student_id', 'student_id');
    }

    public function incomplete_grades()
    {
        return $this->hasMany('App\Grade', 'student_id', 'student_id')->where('remarks', 'incomplete');
    }

    public function drop_grades()
    {
        return $this->hasMany('App\Grade', 'student_id', 'student_id')->where('remarks', 'drop')->where('period', null);
    }
    
    public function activities()
    {
        return $this->morphMany('App\Activity', 'loggable');
    }
}