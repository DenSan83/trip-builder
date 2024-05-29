<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        if (Cache::has('airlines_list')) {
            return Cache::get('airlines_list');
        }

        $airlines = Airline::select('code', 'name')->get();
        Cache::put('airlines_list', $airlines, 60 * 60 * 24); // 1 day cache

        return response()->json(['airlines' => $airlines]);
    }

    public function getAirline(string $airline)
    {
        return Airline::select('code', 'name')
            ->where('code', $airline)->first();
    }
}
