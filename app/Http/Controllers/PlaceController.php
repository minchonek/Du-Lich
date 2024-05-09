<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return response()->json($places);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'place_name' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|numeric|between:1,5',
            'district_id' => 'required|exists:districts,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $place = Place::create($request->all());

        return response()->json($place, 201);
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);
        return response()->json($place);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'place_name' => 'string|max:255',
            'description' => 'string',
            'rating' => 'numeric|between:1,5',
            'district_id' => 'exists:districts,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $place = Place::findOrFail($id);
        $place->update($request->all());

        return response()->json($place, 200);
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return response()->json(['message' => 'Place deleted successfully'], 200);
    }
}
