<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradesItem extends Model
{
    protected $fillable = [
        'grade_id',
        'value',
        'computation_id',
        'computation_name',
        'computation_description',
        'computation_value'
    ];
    
    public function computation()
	{
		return $this->hasOne('App\Computation', 'id', 'computation_id');
	}
}
