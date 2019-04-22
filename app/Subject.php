<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class Subject extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'code',
        'name',
        'description',
        'semester_id',
        'year_id',
        'units'
    ];

    protected $casts = [
        'deleted_at' => 'string',
    ];
    
    public function semester()
	{
		return $this->hasOne('App\Semester', 'id', 'semester_id');
	}
    
    public function year_level()
	{
		return $this->hasOne('App\YearLevel', 'id', 'year_id');
	}
}