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
        'year_id'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];

    protected $appends = [
        'subject',
        'teacher',
    ];
    
    public function subject()
	{
		return $this->hasOne('App\Subject', 'id', 'subject_id');
	}
    
    public function teacher()
	{
		return $this->hasOne('App\User', 'id', 'teacher_id');
	}
}