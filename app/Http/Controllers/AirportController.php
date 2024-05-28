<?php

namespace App\Http\Controllers;

use App\Models\Airport;

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

    public function fetchList()
    {
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

        return response()->json($airports);
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
