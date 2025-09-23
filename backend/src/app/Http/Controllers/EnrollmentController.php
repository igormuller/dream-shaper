<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Http\Resources\EnrollmentResource;
use App\Models\Enrollment;
use Illuminate\Http\Response;

class EnrollmentController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return response()->json(new EnrollmentResource($enrollment));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollmentRequest $request)
    {
        return response()->json(new EnrollmentResource(Enrollment::create($request->validated())), Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());
        return response()->json(new EnrollmentResource($enrollment));
    }
}
