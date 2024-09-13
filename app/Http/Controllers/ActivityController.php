<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ActivityResource::collection(Activity::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {
        $activity = Activity::create($request->except('image'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/activities'); // Store the image in the 'public/activities' directory

            // Save the image path to the database or handle it as needed
            $activity = new Activity();
            $activity->name = $request->input('name');
            $activity->image_path = $imagePath;
            $activity->save();

            return response()->json(['message' => 'Activity created successfully'], 201);
        }
        return new ActivityResource($activity);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return new ActivityResource($activity);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $activity->update($request->all());

        return new ActivityResource($activity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return response()->noContent();
    }
}
