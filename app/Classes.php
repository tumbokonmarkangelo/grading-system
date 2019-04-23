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
        'year_id',
        'status'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];

    public function subjects()
    {
        return $this->hasMany('App\ClassesSubject', 'class_id');
    }

    public function students()
    {
        return $this->hasMany('App\ClassesStudent', 'class_id');
    }
    
    public function semester()
	{
		return $this->hasOne('App\Semester', 'id', 'semester_id');
	}
    
    public function year_level()
	{
		return $this->hasOne('App\YearLevel', 'id', 'year_id');
	}
    
    public function activities()
    {
        return $this->morphMany('App\Activity', 'loggable');
    }
}