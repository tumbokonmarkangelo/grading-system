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
    
    public function student()
	{
		return $this->hasOne('App\User', 'id', 'student_id');
	}
    
    public function activities()
    {
        return $this->morphMany('App\Activity', 'loggable');
    }
}