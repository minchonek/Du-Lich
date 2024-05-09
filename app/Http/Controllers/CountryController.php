<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $country = Country::create($request->all());

        return response()->json($country, 201);
    }

    public function show($id)
    {
        $country = Country::findOrFail($id);
        return response()->json($country);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'country_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $country = Country::findOrFail($id);
        $country->update($request->all());

        return response()->json($country, 200);
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return response()->json(['message' => 'Country deleted successfully'], 200);
    }
}
