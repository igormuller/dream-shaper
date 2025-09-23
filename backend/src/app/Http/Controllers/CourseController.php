<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseStudentResource;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(new CourseCollection(Course::paginate(5)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
        return response()->json(new CourseResource($course), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        return response()->json(new CourseResource($course));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Display the students for the specified course.
     */
    public function students(Course $course)
    {
        return response()->json(CourseStudentResource::collection($course->students));
    }

    /**
     * Display the courses for the specified student.
     */
    public function listByStudent(Student $student)
    {
        $coursesThisStudent = Course::whereHas('students', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })->get();

        if ($coursesThisStudent->isEmpty()) {
            return response()->json(CourseResource::collection(Course::all()));
        }
        $courses = Course::whereNotIn('id', $coursesThisStudent->pluck('id')->all())->get();
        return response()->json(CourseResource::collection($courses));
    }
}
