<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student' => new StudentResource($this->student),
            'course' => new CourseResource($this->course),
            'progress_percentage' => $this->progress_percentage,
            'enrollment_date' => $this->enrollment_date?->format('d/m/Y'),
            'completion_date' => $this->completion_date?->format('d/m/Y')
        ];
    }
}
