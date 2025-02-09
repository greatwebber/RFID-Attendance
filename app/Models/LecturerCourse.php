<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerCourse extends Model
{
    use HasFactory;

    protected $table = 'lecturer_course';

    protected $fillable = ['lecturer_id', 'course_id'];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

