<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course_name', 'course_code', 'department_id','level'];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class, 'lecturer_course');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student')->withTimestamps();
    }


}

