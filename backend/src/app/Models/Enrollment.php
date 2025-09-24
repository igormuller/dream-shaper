<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id', 'progress_percentage', 'enrollment_date', 'completion_date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    protected $casts = [
        'enrollment_date' => 'date',
        'completion_date' => 'date',
    ];

    protected function enrollmentDate(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if (strpos($value, '/')) {
                    return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
                }
                return $value;
            }
        );
    }

    protected function completionDate(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if (strpos($value, '/'))
                    return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
                return $value;
            }
        );
    }
}
