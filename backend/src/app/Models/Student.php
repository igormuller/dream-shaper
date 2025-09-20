<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'cpf'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')->withPivot('progress_percentage', 'enrollment_date', 'completion_date');
    }
}
