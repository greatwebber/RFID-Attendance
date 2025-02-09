<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfidCard extends Model
{
    use HasFactory;

    protected $fillable = ['rfid_number', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
