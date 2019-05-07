<?php

namespace App\Http\Controllers;

use App\Country;
use App\CountryCode;
use App\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Psy\Util\Json;

/**
 * Class LocationController
 *
 * @package App\Http\Controllers;
 */
class LocationController extends Controller
{
    /**
     * @return \App\Location[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Location::all();
    }

    /**
     * @param \App\Location $location
     * @return \App\Location
     */
    public function show(Location $location): Location
    {
        return $location;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $result = $this->validateRequest($request);
        if ('Success' != $result['status']) {

            return response()->json(["status" => $result['status'], 'message' => $result['message']], 400);
        }

        $country = Country::firstOrCreate(
            [
                'code' => $request->input('country'),
                'name' => CountryCode::COUNTRIES[$request->input('country')],
            ]
        );

        $location = Location::create($request->all());

        return response()->json(['status' => 'Success', 'location' => $location], 201);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Location $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Location $location): JsonResponse
    {
        $result = $this->validateRequest($request);
        if ('Success' != $result['status']) {

            return response()->json(["status" => $request['status'], 'message' => $request['message']], 400);
        }

        $location->update($request->all());

        return response()->json($location, 200);
    }

    /**
     * @param \App\Location $location
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json(null, 204);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function validateRequest(Request $request): array
    {
        if (!$request->has("name")) {

            return ['status' => "Error", "message" => "Missing required name",];
        }

        if (!$request->has("address")) {

            return ['status' => "Error", "message" => "Missing required address",];
        }

        if (!$request->has("country")) {

            return ['status' => "Error", "message" => "Missing required country",];
        }

        $country = $request->input('country');
        if (!isset(CountryCode::COUNTRIES[$country])) {

            return ['status' => "Error", "message" => "Invalid country code",];
        }

        return ['status' => 'Success',];
    }
}
