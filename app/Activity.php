<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
		'user_id',
        'log',
        'value_from',
        'value_to',
        'loggable_id',
        'loggable_type'
	];
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function scopeLatest($query)
	{
		return $query->orderBy('created_at', 'desc');
	}

	public function loggable()
	{
		return $this->morphTo();
	}
}
