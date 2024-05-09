<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'province_name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $province = Province::create($request->all());

        return response()->json($province, 201);
    }

    public function show($id)
    {
        $province = Province::findOrFail($id);
        return response()->json($province);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'province_name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $province = Province::findOrFail($id);
        $province->update($request->all());

        return response()->json($province, 200);
    }

    public function destroy($id)
    {
        $province = Province::findOrFail($id);
        $province->delete();

        return response()->json(['message' => 'Province deleted successfully'], 200);
    }
}
