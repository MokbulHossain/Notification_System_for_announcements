<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement_seen extends Model
{
	protected $table = 'announcement_seen';
   protected $fillable = [
        'student_id', 'announcement_id',
    ];
}
