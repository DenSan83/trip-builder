<?php

namespace App\Http\Controllers;

use App\Enums\TripType;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * @OA\Info(
 *     title="Trip Builder",
 *     version="1.0.0",
 *     description="Documentation of the API",
 * )
 */
class TripController extends Controller
{
    /**
     * @OA\Get(
     *     path="/search",
     *     summary="Search trips",
     *     description="Endpoint to search for trips. If a date parameter for an additional segment (e.g., seg2_date) is provided, all parameters for that segment (seg2_date, seg2_from, seg2_to) are required.",
     *    @OA\Parameter(
     *          name="type",
     *          in="query",
     *          description="Type of trip",
     *          required=true,
     *          @OA\Schema(type="string", enum={"oneway", "roundtrip", "multicity", "openjaws"})
     *     ),
     *     @OA\Parameter(
     *         name="seg0_date",
     *         in="query",
     *         description="Date of departure for the first segment",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="seg0_from",
     *         in="query",
     *         description="Departure airport code for the first segment",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg0_to",
     *         in="query",
     *         description="Arrival airport code for the first segment",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg1_date",
     *         in="query",
     *         description="Date of departure for the second segment",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="seg1_from",
     *         in="query",
     *         description="Departure airport code for the second segment",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg1_to",
     *         in="query",
     *         description="Arrival airport code for the second segment",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg2_date",
     *         in="query",
     *         description="Date of departure for the third segment (required if seg2_from or seg2_to are provided)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="seg2_from",
     *         in="query",
     *         description="Departure airport code for the third segment (required if seg2_date is provided)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg2_to",
     *         in="query",
     *         description="Arrival airport code for the third segment (required if seg2_date is provided)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg3_date",
     *         in="query",
     *         description="Date of departure for the fourth segment (required if seg3_from or seg3_to are provided)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="seg3_from",
     *         in="query",
     *         description="Departure airport code for the fourth segment (required if seg3_date is provided)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg3_to",
     *         in="query",
     *         description="Arrival airport code for the fourth segment (required if seg3_date is provided)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg4_date",
     *         in="query",
     *         description="Date of departure for the fifth segment (required if seg4_from or seg4_to are provided)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="seg4_from",
     *         in="query",
     *         description="Departure airport code for the fifth segment (required if seg4_date is provided)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="seg4_to",
     *         in="query",
     *         description="Arrival airport code for the fifth segment (required if seg4_date is provided)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
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

        return response()->json(['search' => $json]);
    }



}
