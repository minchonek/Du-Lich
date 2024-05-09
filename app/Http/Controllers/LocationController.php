<?php

namespace App\Http\Controllers;

use App\Models\Country; 
use App\Models\District; 
use App\Models\Place; 
use App\Models\Province; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of all places.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Fetch all places with eager loading for related models (optional)
        $places = Place::with('district.province.country')->get();

        // Return a JSON response with all places data
        return response()->json($places, 200);
    }

    /**
     * Store a newly created place in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'place_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'required|numeric|between:1,5',
            'district_id' => 'required|exists:districts,id', // Ensure district exists
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create new Place instance
        $place = Place::create($request->all());

        // Return successful response with created place details
        return response()->json($place, 201);
    }

    /**
     * Display the specified place.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        // Find the place by ID
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        // Return a JSON response with the place details
        return response()->json($place, 200);
    }

    /**
     * Update the specified place in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'place_name' => 'string|max:255', // Optional, only validate if provided
            'description' => 'string', // Optional, only validate if provided
            'image' => 'nullable|image|max:2048',
            'rating' => 'numeric|between:1,5', // Optional, only validate if provided
            'district_id' => 'exists:districts,id', // Ensure district exists (optional)
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find the place by ID
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        // Update place attributes and save
        $place->update($request->all());

        // Return successful response with updated place details
        return response()->json($place, 200);
    }

    /**
     * Remove the specified place from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
    // Find the place by ID
    $place = Place::find($id);

    if (!$place) {
        return response()->json(['message' => 'Place not found'], 404);
    }

    // Delete the place
    $place->delete();

    // Return a JSON response indicating successful deletion
    return response()->json(['message' => 'Place deleted successfully'], 200);
    }
}