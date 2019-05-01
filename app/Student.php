<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class Student extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'course',
        'year_id',
        'status'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];
    
    public function year_level()
	{
		return $this->hasOne('App\YearLevel', 'id', 'year_id');
	}
}
