<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCourseResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'progress_percentage' => $this->pivot->progress_percentage,
            'enrollment_id' => $this->pivot->id,
            'enrollment_date' => $this->pivot->enrollment_date,
            'completion_date' => $this->pivot->completion_date,
        ];
    }
}
