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

    public function subjects()
    {
        return $this->hasMany('App\ClassesSubject', 'class_id');
    }

    public function students()
    {
        return $this->hasMany('App\ClassesStudent', 'class_id');
    }
}