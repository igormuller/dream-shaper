<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'duration_hours'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')->withPivot('id', 'progress_percentage', 'enrollment_date', 'completion_date');
    }
}
