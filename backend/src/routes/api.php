<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Sistema para controle de cursos e alunos - DreamShaper';
});


// Route::apiResources([
//     'courses' => CourseController::class,
//     'students' => StudentController::class,
//     'enrollments' => EnrollmentController::class,
// ]);

Route::apiResource('courses', CourseController::class);
Route::apiResource('students', StudentController::class)->except(['destroy']);
Route::apiResource('enrollments', EnrollmentController::class)->only(['show', 'store', 'update']);

Route::get('courses/{course}/students', [CourseController::class, 'students']);
Route::get('students/{student}/courses', [StudentController::class, 'courses']);
Route::get('students-by-course/{course}', [StudentController::class, 'listByCourse']);
Route::get('courses-by-student/{student}', [CourseController::class, 'listByStudent']);