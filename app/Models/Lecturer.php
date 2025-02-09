<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Lecturer extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'department_id', 'password'];

    protected $hidden = ['password'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lecturer) {
            if (empty($lecturer->password)) {
                $lecturer->password = Hash::make('password'); // Default password
            }
        });
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'lecturer_course');
    }
}

