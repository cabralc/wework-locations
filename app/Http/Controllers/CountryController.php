<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Country;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class CountryController
 *
 * @package App\Http\Controllers
 */
class CountryController extends Controller
{
    /**
     * @return \App\Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        return Country::all();
    }

    /**
     * @param \App\Country $country
     * @return \Illuminate\Support\Collection
     */
    public function showLocations(Country $country)
    {
        return $country->location;
    }

    /**
     * @param \App\Country $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function earliestLocation(Country $country)
    {
        $locations = $country->location;
        if ($locations) {
            $sorted = $locations->sortBy('opening_date');

            return response()->json($sorted->values()->all(), 200);
        }

        return response()->json(['status' => 'Error', 'message' => "No locations found"], 404);
    }

    /**
     * @param \App\Country $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function openingNextMonth(Country $country)
    {
        $locations = $country->location;
        if ($locations) {
            $openingNextMonth = [];
            foreach ($locations as $location) {
                $openingDate = Carbon::create($location->opening_date);
                if ($openingDate->isNextMonth()) {
                    $openingNextMonth[] = $location;
                }
            }

            return response()->json($openingNextMonth, 200);
        }

        return response()->json(['status' => 'Error', 'message' => "No locations found"], 404);
    }
}