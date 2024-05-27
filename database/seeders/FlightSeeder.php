<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights = [
            [
                'airline' => 'LH',
                'number' => '401',
                'departure_airport' => 'JFK',
                'departure_time' => '15:53',
                'arrival_airport' => 'FRA',
                'arrival_time' => '05:09',
                'price' => 1200.50
            ],
            [
                'airline' => 'AA',
                'number' => '100',
                'departure_airport' => 'JFK',
                'departure_time' => '08:00',
                'arrival_airport' => 'LHR',
                'arrival_time' => '11:30',
                'price' => 800.75
            ],
            [
                'airline' => 'DL',
                'number' => '123',
                'departure_airport' => 'JFK',
                'departure_time' => '12:45',
                'arrival_airport' => 'ATL',
                'arrival_time' => '14:30',
                'price' => 600.25
            ],
            [
                'airline' => 'EK',
                'number' => '203',
                'departure_airport' => 'DXB',
                'departure_time' => '18:00',
                'arrival_airport' => 'DOH',
                'arrival_time' => '18:45',
                'price' => 350.00
            ],
            [
                'airline' => 'QR',
                'number' => '456',
                'departure_airport' => 'DOH',
                'departure_time' => '10:30',
                'arrival_airport' => 'HKG',
                'arrival_time' => '22:15',
                'price' => 900.80
            ],
            [
                'airline' => 'SQ',
                'number' => '789',
                'departure_airport' => 'SIN',
                'departure_time' => '14:20',
                'arrival_airport' => 'NRT',
                'arrival_time' => '21:05',
                'price' => 1100.00
            ],
            [
                'airline' => 'BA',
                'number' => '234',
                'departure_airport' => 'LHR',
                'departure_time' => '09:15',
                'arrival_airport' => 'CDG',
                'arrival_time' => '11:00',
                'price' => 400.25
            ],
            [
                'airline' => 'AF',
                'number' => '567',
                'departure_airport' => 'CDG',
                'departure_time' => '16:30',
                'arrival_airport' => 'AMS',
                'arrival_time' => '17:45',
                'price' => 250.75
            ],
            [
                'airline' => 'TK',
                'number' => '890',
                'departure_airport' => 'IST',
                'departure_time' => '07:55',
                'arrival_airport' => 'FRA',
                'arrival_time' => '10:30',
                'price' => 300.50
            ],
            [
                'airline' => 'AC',
                'number' => '123',
                'departure_airport' => 'YYZ',
                'departure_time' => '13:20',
                'arrival_airport' => 'SYD',
                'arrival_time' => '07:45',
                'price' => 1500.00
            ],
            [
                'airline' => 'AC',
                'number' => '034',
                'departure_airport' => 'SYD',
                'departure_time' => '10:00',
                'arrival_airport' => 'YYZ',
                'arrival_time' => '06:30',
                'price' => 1400.75
            ],
            [
                'airline' => 'VS',
                'number' => '789',
                'departure_airport' => 'LHR',
                'departure_time' => '19:00',
                'arrival_airport' => 'JFK',
                'arrival_time' => '21:30',
                'price' => 900.80
            ],
            [
                'airline' => 'NH',
                'number' => '123',
                'departure_airport' => 'NRT',
                'departure_time' => '09:45',
                'arrival_airport' => 'SIN',
                'arrival_time' => '16:30',
                'price' => 1300.25
            ],
            [
                'airline' => 'KL',
                'number' => '456',
                'departure_airport' => 'AMS',
                'departure_time' => '11:00',
                'arrival_airport' => 'YYZ',
                'arrival_time' => '13:45',
                'price' => 700.50
            ],
            [
                'airline' => 'EY',
                'number' => '789',
                'departure_airport' => 'AUH',
                'departure_time' => '22:10',
                'arrival_airport' => 'SYD',
                'arrival_time' => '17:30',
                'price' => 1600.00
            ],
            [
                'airline' => 'CX',
                'number' => '123',
                'departure_airport' => 'HKG',
                'departure_time' => '08:30',
                'arrival_airport' => 'SIN',
                'arrival_time' => '11:15',
                'price' => 400.75
            ],
            [
                'airline' => 'AC',
                'number' => '947',
                'departure_airport' => 'YYZ',
                'departure_time' => '14:00',
                'arrival_airport' => 'ATL',
                'arrival_time' => '16:30',
                'price' => 300.25
            ],
            [
                'airline' => 'JL',
                'number' => '789',
                'departure_airport' => 'HND',
                'departure_time' => '17:45',
                'arrival_airport' => 'LHR',
                'arrival_time' => '21:00',
                'price' => 1200.80
            ],
            [
                'airline' => 'LX',
                'number' => '123',
                'departure_airport' => 'ZRH',
                'departure_time' => '10:20',
                'arrival_airport' => 'AMS',
                'arrival_time' => '11:45',
                'price' => 250.50
            ]
        ];

        if (DB::table('flights')->count() === 0) {
            foreach ($flights as $flight) {
                Flight::create($flight);
            }
        } else {
            echo "Flights table is not empty";
        }
    }
}
