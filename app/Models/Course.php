<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course_name', 'course_code', 'department_id'];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class, 'lecturer_course');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

