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
        return City::with('county')->paginate(50);
    }

    public function show(City $city)
    { 
        return $city->load('county');
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

    public function update(Request $request, City $city)
    {
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
        
        return response()->json($city->load('county'));
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(null, 204);
    }
}
