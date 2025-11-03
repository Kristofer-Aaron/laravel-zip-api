<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\County;

class CountyController extends Controller
{
    /**
     * @api {get} /counties Get all counties
     * @apiName GetCounties
     * @apiGroup County
     *
     * @apiSuccess {Object[]} counties List of counties.
     * @apiSuccess {Number} counties.id County unique ID.
     * @apiSuccess {String} counties.name County name.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 200 OK
     *  [
     *      {
     *          "id": 1,
     *          "name": "Sample County"
     *      }
     *  ]
     */
    public function index()
    {
        $counties = County::get();
        return response()->json($counties, 200);
    }

    /**
     * @api {get} /counties/:id Get county by ID
     * @apiName GetCounty
     * @apiGroup County
     *
     * @apiParam {Number} id County unique ID.
     *
     * @apiSuccess {Number} id County unique ID.
     * @apiSuccess {String} name County name.
     *
     * @apiError {String} message Error message.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 200 OK
     *  {
     *      "id": 1,
     *      "name": "Sample County"
     *  }
     *
     * @apiErrorExample {json} Not Found:
     *  HTTP/1.1 404 Not Found
     *  {
     *      "message": "County with id not found"
     *  }
     */
    public function show(int $id)
    {
        $county = County::find($id);
    
        if (!$county) {
            return response()->json(['message' => 'County with id not found'], 404);
        }
    
        return response()->json($county, 200);
    }

    /**
     * @api {post} /counties Create a new county
     * @apiName CreateCounty
     * @apiGroup County
     *
     * @apiBody {String} name County name (unique).
     *
     * @apiSuccess {Number} id County unique ID.
     * @apiSuccess {String} name County name.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 201 Created
     *  {
     *      "id": 1,
     *      "name": "New County"
     *  }
     */
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

    /**
     * @api {put} /counties/:id Update county by ID
     * @apiName UpdateCounty
     * @apiGroup County
     *
     * @apiParam {Number} id County unique ID.
     *
     * @apiBody {String} name County name.
     *
     * @apiSuccess {Number} id County unique ID.
     * @apiSuccess {String} name County name.
     *
     * @apiError {String} message Error message.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 200 OK
     *  {
     *      "id": 1,
     *      "name": "Updated County"
     *  }
     *
     * @apiErrorExample {json} Not Found:
     *  HTTP/1.1 404 Not Found
     *  {
     *      "message": "County with id not found"
     *  }
     */
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

    /**
     * @api {delete} /counties/:id Delete county by ID
     * @apiName DeleteCounty
     * @apiGroup County
     *
     * @apiParam {Number} id County unique ID.
     *
     * @apiSuccessExample {json} Success-Response:
     *  HTTP/1.1 204 No Content
     *
     * @apiError {String} message Error message.
     *
     * @apiErrorExample {json} Not Found:
     *  HTTP/1.1 404 Not Found
     *  {
     *      "message": "County with id not found"
     *  }
     */
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
