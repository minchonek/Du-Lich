<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::all();
        return response()->json($districts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district_name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $district = District::create($request->all());

        return response()->json($district, 201);
    }

    public function show($id)
    {
        $district = District::findOrFail($id);
        return response()->json($district);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'district_name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $district = District::findOrFail($id);
        $district->update($request->all());

        return response()->json($district, 200);
    }

    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        return response()->json(['message' => 'District deleted successfully'], 200);
    }
}
