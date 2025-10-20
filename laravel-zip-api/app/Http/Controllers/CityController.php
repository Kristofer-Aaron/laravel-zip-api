<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\County;

class CityController extends Controller
{
    /**
     * @api {get} /cities List all cities
     * @apiName ListCities
     * @apiGroup City
     * @apiDescription Returns a paginated list of cities with their counties.
     *
     * @apiParam {Number} [page=1] Page number for pagination.
     *
     * @apiSuccess {Object[]} data List of cities.
     * @apiSuccess {Number} data.id City ID.
     * @apiSuccess {String} data.zip Zip code.
     * @apiSuccess {String} data.name City name.
     * @apiSuccess {Number} data.county_id County ID.
     * @apiSuccess {Object} data.county County object.
     */
    public function index()
    {
        return City::with('county')->paginate(50);
    }

    /**
     * @api {get} /cities/:id Get a city
     * @apiName GetCity
     * @apiGroup City
     * @apiDescription Returns a single city by ID, including its county.
     *
     * @apiParam {Number} id City ID.
     *
     * @apiSuccess {Number} id City ID.
     * @apiSuccess {String} zip Zip code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Number} county_id County ID.
     * @apiSuccess {Object} county County object.
     */
    public function show(City $city)
    { 
        return $city->load('county');
    }

    /**
     * @api {post} /cities Create a city
     * @apiName CreateCity
     * @apiGroup City
     * @apiDescription Creates a new city. If the county does not exist, it is automatically created.
     *
     * @apiBody {String} zip Zip code (4 digits).
     * @apiBody {String} name City name.
     * @apiBody {String} county County name.
     *
     * @apiSuccess (201) {Number} id City ID.
     * @apiSuccess {String} zip Zip code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Number} county_id County ID.
     * @apiSuccess {Object} county County object.
     *
     * @apiError (422) {Object} errors Validation errors.
     */
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

    /**
     * @api {put} /cities/:id Update a city
     * @apiName UpdateCity
     * @apiGroup City
     * @apiDescription Updates an existing city. If the county does not exist, it is automatically created.
     *
     * @apiParam {Number} id City ID.
     * @apiBody {String} zip Zip code (4 digits).
     * @apiBody {String} name City name.
     * @apiBody {String} county County name.
     *
     * @apiSuccess {Number} id City ID.
     * @apiSuccess {String} zip Zip code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Number} county_id County ID.
     * @apiSuccess {Object} county County object.
     *
     * @apiError (422) {Object} errors Validation errors.
     */
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

    /**
     * @api {delete} /cities/:id Delete a city
     * @apiName DeleteCity
     * @apiGroup City
     * @apiDescription Deletes a city by ID.
     *
     * @apiParam {Number} id City ID.
     *
     * @apiSuccess (204) No Content.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(null, 204);
    }
}
