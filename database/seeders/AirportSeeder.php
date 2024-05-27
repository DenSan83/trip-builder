<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            [
                'code' => 'AMS',
                'city_code' => 'AMS',
                'name' => 'Amsterdam Airport Schiphol',
                'city' => 'Amsterdam',
                'country_code' => 'NL',
                'region_code' => 'EU',
                'latitude' => 52.3105386,
                'longitude' => 4.7682744,
                'timezone' => 'Europe/Amsterdam'
            ],
            [
                'code' => 'ATL',
                'city_code' => 'ATL',
                'name' => 'Hartsfield-Jackson Atlanta International Airport',
                'city' => 'Atlanta',
                'country_code' => 'US',
                'region_code' => 'NA',
                'latitude' => 33.6404111,
                'longitude' => -84.4198534,
                'timezone' => 'America/New_York'
            ],
            [
                'code' => 'AUH',
                'city_code' => 'AUH',
                'name' => 'Abu Dhabi International Airport',
                'city' => 'Abu Dhabi',
                'country_code' => 'AE',
                'region_code' => 'ME',
                'latitude' => 24.453884,
                'longitude' => 54.3773438,
                'timezone' => 'Asia/Dubai'
            ],
            [
                'code' => 'CDG',
                'city_code' => 'PAR',
                'name' => 'Charles de Gaulle Airport',
                'city' => 'Paris',
                'country_code' => 'FR',
                'region_code' => 'EU',
                'latitude' => 49.0096906,
                'longitude' => 2.5479245,
                'timezone' => 'Europe/Paris'
            ],
            [
                'code' => 'DOH',
                'city_code' => 'DOH',
                'name' => 'Hamad International Airport',
                'city' => 'Doha',
                'country_code' => 'QA',
                'region_code' => 'ME',
                'latitude' => 25.273056,
                'longitude' => 51.608056,
                'timezone' => 'Asia/Qatar'
            ],
            [
                'code' => 'DXB',
                'city_code' => 'DXB',
                'name' => 'Dubai International Airport',
                'city' => 'Dubai',
                'country_code' => 'AE',
                'region_code' => 'ME',
                'latitude' => 25.2531745,
                'longitude' => 55.3656728,
                'timezone' => 'Asia/Dubai'
            ],
            [
                'code' => 'FRA',
                'city_code' => 'FRA',
                'name' => 'Frankfurt am Main Airport',
                'city' => 'Frankfurt',
                'country_code' => 'DE',
                'region_code' => 'EU',
                'latitude' => 50.0379339,
                'longitude' => 8.5621518,
                'timezone' => 'Europe/Berlin'
            ],
            [
                'code' => 'HND',
                'city_code' => 'TYO',
                'name' => 'Haneda Airport',
                'city' => 'Tokyo',
                'country_code' => 'JP',
                'region_code' => 'AS',
                'latitude' => 35.5493932,
                'longitude' => 139.7798386,
                'timezone' => 'Asia/Tokyo'
            ],
            [
                'code' => 'HKG',
                'city_code' => 'HKG',
                'name' => 'Hong Kong International Airport',
                'city' => 'Hong Kong',
                'country_code' => 'HK',
                'region_code' => 'AS',
                'latitude' => 22.308046,
                'longitude' => 113.918480,
                'timezone' => 'Asia/Hong_Kong'
            ],
            [
                'code' => 'IST',
                'city_code' => 'IST',
                'name' => 'Istanbul Airport',
                'city' => 'Istanbul',
                'country_code' => 'TR',
                'region_code' => 'EU',
                'latitude' => 41.275278,
                'longitude' => 28.751944,
                'timezone' => 'Europe/Istanbul'
            ],
            [
                'code' => 'JFK',
                'city_code' => 'NYC',
                'name' => 'John F. Kennedy International Airport',
                'city' => 'New York',
                'country_code' => 'US',
                'region_code' => 'NA',
                'latitude' => 40.6413111,
                'longitude' => -73.7781391,
                'timezone' => 'America/New_York'
            ],
            [
                'code' => 'LHR',
                'city_code' => 'LON',
                'name' => 'Heathrow Airport',
                'city' => 'London',
                'country_code' => 'GB',
                'region_code' => 'EU',
                'latitude' => 51.4700223,
                'longitude' => -0.4542955,
                'timezone' => 'Europe/London'
            ],
            [
                'code' => 'NRT',
                'city_code' => 'TYO',
                'name' => 'Narita International Airport',
                'city' => 'Tokyo',
                'country_code' => 'JP',
                'region_code' => 'AS',
                'latitude' => 35.764722,
                'longitude' => 140.386389,
                'timezone' => 'Asia/Tokyo'
            ],
            [
                'code' => 'ORD',
                'city_code' => 'CHI',
                'name' => 'O\'Hare International Airport',
                'city' => 'Chicago',
                'country_code' => 'US',
                'region_code' => 'NA',
                'latitude' => 41.9741625,
                'longitude' => -87.9073214,
                'timezone' => 'America/Chicago'
            ],
            [
                'code' => 'SIN',
                'city_code' => 'SIN',
                'name' => 'Singapore Changi Airport',
                'city' => 'Singapore',
                'country_code' => 'SG',
                'region_code' => 'AS',
                'latitude' => 1.3644201,
                'longitude' => 103.9915305,
                'timezone' => 'Asia/Singapore'
            ],
            [
                'code' => 'SYD',
                'city_code' => 'SYD',
                'name' => 'Sydney Kingsford Smith Airport',
                'city' => 'Sydney',
                'country_code' => 'AU',
                'region_code' => 'OC',
                'latitude' => -33.9399228,
                'longitude' => 151.1752764,
                'timezone' => 'Australia/Sydney'
            ],
            [
                'code' => 'YUL',
                'city_code' => 'YMQ',
                'name' => 'Pierre Elliott Trudeau International',
                'city' => 'Montreal',
                'country_code' => 'CA',
                'region_code' => 'QC',
                'latitude' => 45.457714,
                'longitude' => -73.749908,
                'timezone' => 'America/Toronto'
            ],
            [
                'code' => 'YVR',
                'city_code' => 'YVR',
                'name' => 'Vancouver International',
                'city' => 'Vancouver',
                'country_code' => 'CA',
                'region_code' => 'BC',
                'latitude' => 49.194698,
                'longitude' => -123.179192,
                'timezone' => 'America/Vancouver'
            ],
            [
                'code' => 'YYZ',
                'city_code' => 'YYZ',
                'name' => 'Toronto Pearson International Airport',
                'city' => 'Toronto',
                'country_code' => 'CA',
                'region_code' => 'NA',
                'latitude' => 43.6777176,
                'longitude' => -79.6248197,
                'timezone' => 'America/Toronto'
            ],
            [
                'code' => 'ZRH',
                'city_code' => 'ZRH',
                'name' => 'Zurich Airport',
                'city' => 'Zurich',
                'country_code' => 'CH',
                'region_code' => 'EU',
                'latitude' => 47.458056,
                'longitude' => 8.548056,
                'timezone' => 'Europe/Zurich'
            ]
        ];

        if (DB::table('airports')->count() === 0) {
            foreach ($airports as $airport) {
                Airport::create($airport);
            }
        } else {
            echo "Airports table is not empty";
        }
    }
}
