<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        $enrollmentDate = $this->faker->dateTimeBetween('2025-01-01', '2025-12-31');

        return [
            'student_id'          => Student::inRandomOrder()->first()->id ?? Student::factory(),
            'course_id'           => Course::inRandomOrder()->first()->id ?? Course::factory(),
            'progress_percentage' => $this->faker->numberBetween(0, 100),
            'enrollment_date'     => $enrollmentDate->format('Y-m-d'),
            'completion_date'     => $this->faker->boolean(70) 
                                        ? $this->faker->dateTimeBetween($enrollmentDate, '2026-12-31')->format('Y-m-d')
                                        : null,
        ];
    }
}
