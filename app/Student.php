<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $fillable = [
        'name', 'email','department_name', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];
}
