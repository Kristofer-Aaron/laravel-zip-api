<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\County;

class CountyController extends Controller
{
    public function index()
    {
        $counties = County::get();
        return response()->json($counties, 200);
    }

    public function show(int $id)
    {
        $county = County::find($id);
    
        if (!$county) {
            return response()->json(['message' => 'County with id not found'], 404);
        }
    
        return response()->json($county, 200);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:counties,name',
        ]);

        $county = County::create([
            'name' => $data['name'],
        ]);

        return response()->json($county, 201);
    }

    public function update(Request $request, int $id)
    {
        $county = County::find($id);

        if (!$county) {
            return response()->json(['message' => 'County with id not found'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $county->update([
            'name' => $data['name'], 
        ]);
        
        return response()->json($county, 200);
    }

    public function destroy(int $id)
    {
        $county = County::find($id);

        if (!$county) {
            return response()->json(['message' => 'County with id not found'], 404);
        }

        $county->delete();
        return response()->json(null, 204);
    }
}