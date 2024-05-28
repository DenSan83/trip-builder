<?php

namespace App\Http\Controllers;

use App\Enums\TripType;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    public function tripBuilder(Request $request)
    {
        $typeParam = $request->query('type');
        $airlineParam = $request->query('airline');

        // Verify type
        if (empty($typeParam)) {
            return response()->json([
                'error' => 'Type parameter not found. It should be one of the following: ' . implode(', ', array_map(fn($t) => $t->value, TripType::cases()))
            ], 400);
        }
        $type = TripType::from($typeParam);

        // Verify Airline
        $airlineController = new AirlineController();
        $airline = null;
        if (!is_null($airlineParam)) {
            if ($airlineController->checkIfExists($airlineParam)) {
                $airline = $airlineParam;
            } else {
                return response()->json([
                    'error' => "Airline {$airlineParam} not found."
                ], 400);
            }
        }

        $trips = [];
        $airportCodes = [];
        $now = Carbon::now();
        $oneYearLater = $now->copy()->addYear()->subDay();
        for ($i = 0; $request->query("seg{$i}_from") && $request->query("seg{$i}_to") && $request->query("seg{$i}_date"); $i++) {
            $departure = $request->query("seg{$i}_from");
            $arrival = $request->query("seg{$i}_to");
            $departure_date = $request->query("seg{$i}_date");

            $airportCodes[] = $departure;
            $airportCodes[] = $arrival;

            $validator = Validator::make(['departure_date' => $departure_date], [
                'departure_date' => [
                    'required',
                    'date',
                    'date_format:Y-m-d',
                    'after_or_equal:' . $now->format('Y-m-d'),
                    'before_or_equal:' . $oneYearLater->format('Y-m-d')
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => "Departure date of segment $i is not valid ({$departure_date})."
                ], 400);
            }

            $trips[] = [
                'departure' => $departure,
                'arrival' => $arrival,
                'date' => $departure_date
            ];
        }

        if (count($trips) == 0) {
            return response()->json([
                'error' => 'You must provide at least one segment.'
            ], 400);
        }

        $airportController = new AirportController();
        if (!empty($nonExistingAirports = $airportController->checkIfExists($airportCodes))) {
            return response()->json([
                'error' => 'The following airports could not be found: ' . $nonExistingAirports
            ], 400);
        }

        // Find required flights data
        $flightController = new FlightController();
        $airlines = [];
        $airports = [];
        $flights = [];
        $final_price = 0.0;
        $errors = [];
        foreach ($trips as $trip) {
            $flight = $flightController->find($trip['departure'], $trip['arrival'], $trip['date'], $airline);

            if ($flight instanceof Flight) {
                $airlineObj = $airlineController->getAirline($flight->airline);
                if (!in_array($airlineObj, $airlines)) $airlines[] = $airlineObj;

                $departureAirport = $airportController->getAirport($flight->departure_airport);
                if (!in_array($departureAirport, $airports)) $airports[] = $departureAirport;

                $arrivalAirport = $airportController->getAirport($flight->arrival_airport);
                if (!in_array($arrivalAirport, $airports)) $airports[] = $arrivalAirport;

                $final_price += (float) $flight->price;
                $flights[] = $flight;
            } else {
                $errors[] = $flight;
            }
        }

        $json = [
            'airlines' => $airlines,
            'airports' => $airports,
            'flights' => $flights,
            'type' => $type,
            'final_price' => number_format($final_price, 2),
        ];

        if (!empty($errors)) $json['errors'] = $errors;

        return response()->json([$json]);
    }



}
