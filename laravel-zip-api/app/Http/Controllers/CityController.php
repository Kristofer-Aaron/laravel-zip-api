<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\County;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('county')->get();
        return response()->json($cities, 200);
    }

    
    public function show(int $id)
    {
        $city = City::with('county')->find($id);

        if (!$city) {
            return response()->json(['message' => 'City with id not found'], 404);
        }

        return response()->json($city, 200);
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'zip' => 'required|digits:4',
            'name' => 'required|string|max:255',
            'county' => 'required|string|max:255',
        ]);
        
        $county = County::firstOrCreate(['name' => $data['county']]);
        
        $city = City::create([
            'zip' => $data['zip'],
            'name' => $data['name'],
            'county_id' => $county->id,
        ]);

        return response()->json($city->load('county'), 201);
    }


    public function update(Request $request, int $id)
    {
        $city = City::with('county')->find($id);

        if (!$city) {
            return response()->json(['message' => 'City with id not found'], 404);
        }

        $data = $request->validate([
            'zip' => 'required|digits:4',
            'name' => 'required|string|max:255',
            'county' => 'required|string|max:255',
        ]);
        
        $county = County::firstOrCreate(['name' => $data['county']]);
        
        $city->update([
            'zip' => $data['zip'],
            'name' => $data['name'], 
            'county_id' => $county->id,
        ]);
        
        return response()->json($city->load('county'), 200);
    }


    public function destroy(int $id)
    {
        $city = City::with('county')->find($id);

        if (!$city) {
            return response()->json(['message' => 'City with id not found'], 404);
        }

        $city->delete();
        return response()->json(null, 204);
    }
}
