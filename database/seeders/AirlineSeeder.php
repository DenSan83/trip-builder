<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            [
                'code' => 'AA',
                'name' => 'American Airlines'
            ],
            [
                'code' => 'AC',
                'name' => 'Air Canada'
            ],
            [
                'code' => 'AF',
                'name' => 'Air France'
            ],
            [
                'code' => 'BA',
                'name' => 'British Airways'
            ],
            [
                'code' => 'CX',
                'name' => 'Cathay Pacific'
            ],
            [
                'code' => 'DL',
                'name' => 'Delta Air Lines'
            ],
            [
                'code' => 'EK',
                'name' => 'Emirates'
            ],
            [
                'code' => 'EY',
                'name' => 'Etihad Airways'
            ],
            [
                'code' => 'JL',
                'name' => 'Japan Airlines'
            ],
            [
                'code' => 'KL',
                'name' => 'KLM Royal Dutch Airlines'
            ],
            [
                'code' => 'LH',
                'name' => 'Lufthansa'
            ],
            [
                'code' => 'LX',
                'name' => 'Swiss International Air Lines'
            ],
            [
                'code' => 'NH',
                'name' => 'ANA - All Nippon Airways'
            ],
            [
                'code' => 'QF',
                'name' => 'Qantas Airways'
            ],
            [
                'code' => 'QR',
                'name' => 'Qatar Airways'
            ],
            [
                'code' => 'SQ',
                'name' => 'Singapore Airlines'
            ],
            [
                'code' => 'TK',
                'name' => 'Turkish Airlines'
            ],
            [
                'code' => 'UA',
                'name' => 'United Airlines'
            ],
            [
                'code' => 'VS',
                'name' => 'Virgin Atlantic Airways'
            ],
            [
                'code' => 'WN',
                'name' => 'Southwest Airlines'
            ]
        ];

        if (DB::table('airlines')->count() === 0) {
            foreach ($airlines as $airline) {
                Airline::create($airline);
            }
        } else {
            echo "Airlines table is not empty";
        }
    }
}
