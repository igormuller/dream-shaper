<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnrollmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => ['required', Rule::unique('enrollments', 'student_id')->where('course_id', $this->course_id), Rule::exists('students', 'id')],
            'course_id' => ['required', Rule::unique('enrollments', 'course_id')->where('student_id', $this->student_id), Rule::exists('courses', 'id')],
            'progress_percentage' => 'nullable|numeric|min:0|max:100',
            'enrollment_date' => 'nullable|date',
            'completion_date' => 'nullable|date|after_or_equal:enrollment_date',
        ];
    }
}
