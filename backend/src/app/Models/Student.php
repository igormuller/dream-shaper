<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'cpf'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')->withPivot('id', 'progress_percentage', 'enrollment_date', 'completion_date');
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 
                preg_replace(
                    '/(\d{3})(\d{3})(\d{3})(\d{2})/',
                    '$1.$2.$3-$4',
                    $value
                )
                : null,
            set: fn ($value) => $value ?
                preg_replace('/\D/', '', $value)
                : null
        );
    }
}
