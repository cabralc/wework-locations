<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Country;
use App\CountryCode;
use App\Floor;
use App\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Psy\Util\Json;

/**
 * Class FloorController
 *
 * @package App\Http\Controllers
 */
class FloorController extends Controller
{
    /**
     * @param \App\Location $location
     * @return \Illuminate\Support\Collection
     */
    public function showFloors(Location $location): Collection
    {
        return $location->floor;
    }

    /**
     * @param \App\Location $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function floorsAmount(Location $location): JsonResponse
    {
        return response()->json(["floorsAmount" => $location->floor->count()], 200);
    }

    public function desksAmount(Location $location)
    {
        $floors = $location->floor;
        $desks  = 0;
        if ($floors) {
            foreach ($floors as $floor) {
                $desks += $floor->desks;
            }
        }
        return response()->json(["desksAmount" => $desks], 200);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Location $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Location $location): JsonResponse
    {
        $result = $this->validateRequest($request, $location);
        if ('Success' != $result['status']) {

            return response()->json(["status" => $result['status'], 'message' => $result['message']], 400);
        }

        $input    = $request->input();
        $location = Floor::create(array_merge($input, ['location_id' => $location->id,]));

        return response()->json(['status' => 'Success', 'location' => $location], 201);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Location $location
     * @return array
     */
    private function validateRequest(Request $request, Location $location): array
    {
        if (!$request->has("number")) {

            return ['status' => "Error", "message" => "Missing required number",];
        }

        if (!$request->has("description")) {

            return ['status' => "Error", "message" => "Missing required description",];
        }

        if (!$request->has("desks")) {

            return ['status' => "Error", "message" => "Missing required desks",];
        }

        $floors = $location->floor;
        if ($floors) {
            // Check to see if any have the same floor
            foreach ($floors as $floor) {
                if ($floor->number == $request->input("number")) {

                    return ['status' => "Error", "message" => "Duplicate floor number",];
                }
            }
        }

        return ['status' => 'Success',];
    }
}