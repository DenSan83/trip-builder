<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Support\Facades\Cache;

class AirportController extends Controller
{
    public function checkIfExists(array $airportCodes): string
    {
        $doesntExist = [];
        foreach ($airportCodes as $airportCode) {
            if (!Airport::where('code', $airportCode)->exists()) {
                $doesntExist[] = $airportCode;
            }
        }

        return implode(', ', $doesntExist);
    }

    /**
     * @OA\Get(
     *     path="/api/airports",
     *     summary="Fetch list of airports",
     *     description="Endpoint to fetch the list of airports",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      )
     * )
     */
    public function fetchList()
    {
        if (Cache::has('airports_list')) {
            return Cache::get('airports_list');
        }

        $airports = Airport::select(
            'code',
            'city_code',
            'name',
            'city',
            'country_code',
            'region_code',
            'latitude',
            'longitude',
            'timezone'
        )->get();
        Cache::put('airports_list', $airports, 60 * 60 * 24); // 1 day cache

        return response()->json(['airports' => $airports]);
    }

    public function getAirport(string $airport)
    {
        return Airport::select(
            'code',
            'city_code',
            'name',
            'city',
            'country_code',
            'region_code',
            'latitude',
            'longitude',
            'timezone'
        )->where('code', $airport)->first();
    }
}
