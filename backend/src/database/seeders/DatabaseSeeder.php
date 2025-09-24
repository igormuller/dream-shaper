<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar 30 alunos
        $students = Student::factory(30)->create();

        // Criar 10 cursos
        $courses = Course::factory(10)->create();

        // Criar 100 matrículas distribuídas em todos os meses
        Enrollment::factory(100)->create();
    }
}
