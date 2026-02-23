<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    private $apiUrl = 'http://localhost:8000/api';

    public function index()
    {
        try {
            $response = Http::get("{$this->apiUrl}/cities");
            $cities = $response->json();
            return view('cities.index', ['cities' => $cities]);
        } catch (\Exception $e) {
            return view('cities.index', ['cities' => [], 'error' => 'Failed to fetch cities']);
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/cities/{$id}");
            $city = $response->json();
            return view('cities.show', ['city' => $city]);
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'City not found');
        }
    }

    public function create()
    {
        try {
            $response = Http::get("{$this->apiUrl}/counties");
            $counties = $response->json();
            return view('cities.create', ['counties' => $counties]);
        } catch (\Exception $e) {
            return view('cities.create', ['counties' => [], 'error' => 'Failed to fetch counties']);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'county_id' => 'required|integer',
            'zip' => 'nullable|string|max:10',
        ]);

        try {
            $response = Http::post("{$this->apiUrl}/cities", $validated);
            return redirect()->route('cities.index')->with('success', 'City created successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create city');
        }
    }

    public function edit($id)
    {
        try {
            $cityResponse = Http::get("{$this->apiUrl}/cities/{$id}");
            $city = $cityResponse->json();
            $countiesResponse = Http::get("{$this->apiUrl}/counties");
            $counties = $countiesResponse->json();
            return view('cities.edit', ['city' => $city, 'counties' => $counties]);
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'City not found');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'county_id' => 'required|integer',
            'zip' => 'nullable|string|max:10',
        ]);

        try {
            $response = Http::put("{$this->apiUrl}/cities/{$id}", $validated);
            return redirect()->route('cities.index')->with('success', 'City updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update city');
        }
    }

    public function destroy($id)
    {
        try {
            Http::delete("{$this->apiUrl}/cities/{$id}");
            return redirect()->route('cities.index')->with('success', 'City deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'Failed to delete city');
        }
    }
}
