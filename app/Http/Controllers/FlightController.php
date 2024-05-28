<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function find(string $depart, string $arrive, string $date, string $airline = null)
    {
        $query = Flight::select(
                'airline',
                'number',
                'departure_airport',
                'departure_time',
                'arrival_airport',
                'arrival_time',
                'price')
            ->where('departure_airport', $depart)
            ->where('arrival_airport', $arrive);

        if ($airline) {
            $query->where('airline', $airline);
        }
        $flight = $query->first();

        if (empty($flight)) {
            return "No flights were found for the trip {$depart}-{$arrive}";
        }

        // Since all flights are available all days, we'll artificially insert the desired date as available date
        $flight->departure_date = $date;
        return $flight;
    }

    public function fetchList(Request $request)
    {
        $airline = $request->query('airline');
        $query = Flight::select(
            'airline',
            'number',
            'departure_airport',
            'departure_time',
            'arrival_airport',
            'arrival_time',
            'price');

        if ($airline) {
            $query->where('airline', $airline);
        }
        return $query->get();
    }

}
