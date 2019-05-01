<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;  

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'username',
        'type',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'string',
    ];

    public function getNameAttribute()
    {
        $first_name = (!empty($this->first_name) ? $this->first_name . ' ' : '');
        $middle_name = (!empty($this->middle_name) ? $this->middle_name . ' ' : '');
        $last_name = (!empty($this->last_name) ? $this->last_name : '');
        return "{$first_name}{$middle_name}{$last_name}";
    }

    public function grades()
    {
        return $this->hasMany('App\Grade', 'student_id');
    }

    public function incomplete_grades()
    {
        return $this->hasMany('App\Grade', 'student_id')->where('remarks', 'incomplete');
    }

    public function drop_grades()
    {
        return $this->hasMany('App\Grade', 'student_id')->where('remarks', 'drop')->where('period', null);
    }

    public function drop_classes()
    {
        return $this->hasMany('App\ClassesStudent', 'student_id')->where('status', 'drop');
    }
    
    public function activities()
    {
        return $this->morphMany('App\Activity', 'loggable');
    }

    public function student_info()
    {
        return $this->hasOne('App\Student', 'user_id');
    }
    
    public function classes()
	{
        if ($this->type == 'teacher') {
            return $this->hasMany('App\ClassesSubject', 'teacher_id');
        } else if ($this->type == 'student') {
            return $this->hasMany('App\ClassesStudent', 'student_id');
        }
	}
}
