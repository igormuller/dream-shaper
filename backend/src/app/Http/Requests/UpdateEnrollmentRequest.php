<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrollmentRequest extends FormRequest
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
            'progress_percentage' => 'required|numeric|min:0|max:100',
            'enrollment_date' => 'nullable|date_format:d/m/Y',
            'completion_date' => 'nullable|date_format:d/m/Y|after_or_equal:enrollment_date',
        ];
    }
}
