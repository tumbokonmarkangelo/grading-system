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
        'computed_grade',
        'period',
        'scale'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];

    public function items()
    {
        return $this->hasMany('App\GradesItem', 'grade_id');
    }
    
    public function classes_subject()
	{
		return $this->hasOne('App\ClassesSubject', 'id', 'classes_subject_id');
	}
    
    public function student()
	{
		return $this->hasOne('App\User', 'id', 'student_id');
	}
}
