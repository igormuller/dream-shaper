<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\StudentResource;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(StudentResource::collection(Student::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        return response()->json(new StudentResource($student), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return response()->json(new StudentResource($student));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Display the courses for the specified student.
     */
    public function courses(Student $student)
    {
        return response()->json(CourseResource::collection($student->courses));
    }

    /**
     * Display the courses for the specified student.
     */
    public function listByCourse(Course $course)
    {
        $studentsThisCourse = Student::whereHas('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        if ($studentsThisCourse->isEmpty()) {
            return response()->json(StudentResource::collection(Student::all()));
        }
        $students = Student::whereNotIn('id', $studentsThisCourse->pluck('id')->all())->get();
        return response()->json(StudentResource::collection($students));
    }
}
