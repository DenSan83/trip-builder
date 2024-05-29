<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function checkIfExists(string $airline): bool
    {
        return Airline::where('code', $airline)->exists();
    }

    /**
     * @OA\Get(
     *     path="/api/airlines",
     *     summary="Fetch list of airlines",
     *     description="Endpoint to fetch the list of airlines",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      )
     * )
     */
    public function fetchList()
    {
        $airlines = Airline::select('code', 'name')->get();

        return response()->json(['airlines' => $airlines]);
    }

    public function getAirline(string $airline)
    {
        return Airline::select('code', 'name')
            ->where('code', $airline)->first();
    }
}
