<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\County;

class CityController extends Controller
{
    /**
     * @api {get} /cities Get all cities
     * @apiName GetCities
     * @apiGroup City
     *
     * @apiSuccess {Object[]} cities List of cities.
     * @apiSuccess {Number} cities.id City unique ID.
     * @apiSuccess {String} cities.zip City ZIP code.
     * @apiSuccess {String} cities.name City name.
     * @apiSuccess {Object} cities.county Associated county.
     * @apiSuccess {Number} cities.county.id County ID.
     * @apiSuccess {String} cities.county.name County name.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 200 OK
     *  [
     *      {
     *          "id": 1,
     *          "zip": "1234",
     *          "name": "Sample City",
     *          "county": {
     *              "id": 1,
     *              "name": "Sample County"
     *          }
     *      }
     *  ]
     */
    public function index()
    {
        $cities = City::with('county')->get();
        return response()->json($cities, 200);
    }

    /**
     * @api {get} /cities/:id Get city by ID
     * @apiName GetCity
     * @apiGroup City
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiSuccess {Number} id City unique ID.
     * @apiSuccess {String} zip City ZIP code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Object} county Associated county.
     * @apiSuccess {Number} county.id County ID.
     * @apiSuccess {String} county.name County name.
     *
     * @apiError {String} message Error message.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 200 OK
     *  {
     *      "id": 1,
     *      "zip": "1234",
     *      "name": "Sample City",
     *      "county": {
     *          "id": 1,
     *          "name": "Sample County"
     *      }
     *  }
     *
     * @apiErrorExample {json} Not Found:
     *  HTTP/1.1 404 Not Found
     *  {
     *      "message": "City with id not found"
     *  }
     */
    public function show(int $id)
    {
        $city = City::with('county')->find($id);

        if (!$city) {
            return response()->json(['message' => 'City with id not found'], 404);
        }

        return response()->json($city, 200);
    }

    /**
     * @api {post} /cities Create a new city
     * @apiName CreateCity
     * @apiGroup City
     *
     * @apiBody {String} zip City ZIP code (4 digits).
     * @apiBody {String} name City name.
     * @apiBody {String} county County name.
     *
     * @apiSuccess {Number} id City unique ID.
     * @apiSuccess {String} zip City ZIP code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Object} county Associated county.
     * @apiSuccess {Number} county.id County ID.
     * @apiSuccess {String} county.name County name.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 201 Created
     *  {
     *      "id": 1,
     *      "zip": "1234",
     *      "name": "New City",
     *      "county": {
     *          "id": 1,
     *          "name": "New County"
     *      }
     *  }
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
     * @api {put} /cities/:id Update city by ID
     * @apiName UpdateCity
     * @apiGroup City
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiBody {String} zip City ZIP code (4 digits).
     * @apiBody {String} name City name.
     * @apiBody {String} county County name.
     *
     * @apiSuccess {Number} id City unique ID.
     * @apiSuccess {String} zip City ZIP code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Object} county Associated county.
     * @apiSuccess {Number} county.id County ID.
     * @apiSuccess {String} county.name County name.
     *
     * @apiError {String} message Error message.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 200 OK
     *  {
     *      "id": 1,
     *      "zip": "1234",
     *      "name": "Updated City",
     *      "county": {
     *          "id": 1,
     *          "name": "Updated County"
     *      }
     *  }
     *
     * @apiErrorExample {json} Not Found:
     *  HTTP/1.1 404 Not Found
     *  {
     *      "message": "City with id not found"
     *  }
     */
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

    /**
     * @api {delete} /cities/:id Delete city by ID
     * @apiName DeleteCity
     * @apiGroup City
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 204 No Content
     *
     * @apiError {String} message Error message.
     *
     * @apiErrorExample {json} Not Found:
     *  HTTP/1.1 404 Not Found
     *  {
     *      "message": "City with id not found"
     *  }
     */
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
