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

    public function fetchList()
    {
        $airlines = Airline::select('code', 'name')->get();

        return response()->json($airlines);
    }

    public function getAirline(string $airline)
    {
        return Airline::select('code', 'name')
            ->where('code', $airline)->first();
    }
}
