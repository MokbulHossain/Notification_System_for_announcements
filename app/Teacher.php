<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
     protected $fillable = [
        'name', 'email','rank', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];
    
     public function courses(){
        return $this->belongsToMany(Course::class);
    }
}
