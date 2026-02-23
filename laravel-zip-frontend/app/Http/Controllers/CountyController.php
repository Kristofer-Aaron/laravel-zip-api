<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountyController extends Controller
{
    private $apiUrl = 'http://localhost:8000/api';

    public function index()
    {
        try {
            $response = Http::get("{$this->apiUrl}/counties");
            $counties = $response->json();
            return view('counties.index', ['counties' => $counties]);
        } catch (\Exception $e) {
            return view('counties.index', ['counties' => [], 'error' => 'Failed to fetch counties']);
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/counties/{$id}");
            $county = $response->json();
            return view('counties.show', ['county' => $county]);
        } catch (\Exception $e) {
            return redirect()->route('counties.index')->with('error', 'County not found');
        }
    }

    public function create()
    {
        return view('counties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $response = Http::post("{$this->apiUrl}/counties", $validated);
            return redirect()->route('counties.index')->with('success', 'County created successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create county');
        }
    }

    public function edit($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/counties/{$id}");
            $county = $response->json();
            return view('counties.edit', ['county' => $county]);
        } catch (\Exception $e) {
            return redirect()->route('counties.index')->with('error', 'County not found');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $response = Http::put("{$this->apiUrl}/counties/{$id}", $validated);
            return redirect()->route('counties.index')->with('success', 'County updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update county');
        }
    }

    public function destroy($id)
    {
        try {
            Http::delete("{$this->apiUrl}/counties/{$id}");
            return redirect()->route('counties.index')->with('success', 'County deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('counties.index')->with('error', 'Failed to delete county');
        }
    }
}
