<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
   protected $fillable = [
        'teacher_id', 'course_id','semister_name', 'details'
    ];
    
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
