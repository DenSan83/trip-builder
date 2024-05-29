<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EndpointsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the search endpoint.
     *
     * @return void
     */
    public function test_search_endpoint_returns_expected_json_structure()
    {
        // Arrange
        $this->seedAirlines();
        $this->seedAirports();
        $this->seedFlights();

        // Act
        $response = $this->getJson('/search?seg0_date=2024-06-29&seg0_from=LHR&seg0_to=CDG&seg1_date=2024-07-09&seg1_from=CDG&seg1_to=AMS&type=multicity');

        // Assert
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'airlines' => [
                        ['code' => 'BA', 'name' => 'British Airways'],
                        ['code' => 'AF', 'name' => 'Air France']
                    ],
                    'airports' => [
                        ['code' => 'LHR', 'city_code' => 'LON', 'name' => 'Heathrow Airport', 'city' => 'London', 'country_code' => 'GB'],
                        ['code' => 'CDG', 'city_code' => 'PAR', 'name' => 'Charles de Gaulle Airport', 'city' => 'Paris', 'country_code' => 'FR'],
                        ['code' => 'AMS', 'city_code' => 'AMS', 'name' => 'Amsterdam Airport Schiphol', 'city' => 'Amsterdam', 'country_code' => 'NL']
                    ],
                    'flights' => [
                        ['airline' => 'BA', 'number' => '234', 'departure_airport' => 'LHR', 'departure_time' => '09:15:00', 'arrival_airport' => 'CDG', 'arrival_time' => '11:00:00', 'price' => '400.25', 'departure_date' => '2024-06-29'],
                        ['airline' => 'AF', 'number' => '567', 'departure_airport' => 'CDG', 'departure_time' => '16:30:00', 'arrival_airport' => 'AMS', 'arrival_time' => '17:45:00', 'price' => '250.75', 'departure_date' => '2024-07-09']
                    ],
                    'type' => 'multicity',
                    'final_price' => '651.00'
                ]
            ]);
    }

    /**
     * Test the search endpoint with a date too early
     *
     * @return void
     */
    public function test_search_endpoint_returns_error_on_invalid_departure_date()
    {
        // Act
        $response = $this->getJson('/search?seg0_date=2024-05-28&seg0_from=LHR&seg0_to=CDG&type=oneway');

        // Assert
        $response->assertStatus(400);
    }

    /**
     * Test the airlines endpoint.
     *
     * @return void
     */
    public function test_airlines_endpoint_returns_expected_json_structure()
    {
        // Act
        $response = $this->getJson('/api/airlines');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['code', 'name']
            ]);
    }

    /**
     * Test the airports endpoint.
     *
     * @return void
     */
    public function test_airports_endpoint_returns_expected_json_structure()
    {
        // Act
        $response = $this->getJson('/api/airports');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['code', 'city_code', 'name', 'city', 'country_code']
            ]);
    }

    /**
     * Test the flights endpoint.
     *
     * @return void
     */
    public function test_flights_endpoint_returns_expected_json_structure()
    {
        // Act
        $response = $this->getJson('/api/flights');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['airline', 'number', 'departure_airport', 'departure_time', 'arrival_airport', 'arrival_time', 'price']
            ]);
    }


    /**
     * Protected seeders
     *
     * @return void
     */
    protected function seedAirlines()
    {
        Airline::create(['code' => 'BA', 'name' => 'British Airways']);
        Airline::create(['code' => 'AF', 'name' => 'Air France']);
    }
    protected function seedAirports()
    {
        Airport::create(['code' => 'LHR', 'city_code' => 'LON', 'name' => 'Heathrow Airport', 'city' => 'London',
            'country_code' => 'GB', 'region_code' => 'EU', 'latitude' => '51.4700223', 'longitude' => '-0.4542955', 'timezone' => 'Europe/London']);
        Airport::create(['code' => 'CDG', 'city_code' => 'PAR', 'name' => 'Charles de Gaulle Airport', 'city' => 'Paris',
            'country_code' => 'FR', 'region_code' => 'EU', 'latitude' => '49.0096906', 'longitude' => '2.5479245', 'timezone' => 'Europe/Paris']);
        Airport::create(['code' => 'AMS', 'city_code' => 'AMS', 'name' => 'Amsterdam Airport Schiphol', 'city' => 'Amsterdam',
            'country_code' => 'NL', 'region_code' => 'EU', 'latitude' => '52.3105386', 'longitude' => '4.7682744', 'timezone' => 'Europe/Amsterdam']);
    }
    protected function seedFlights()
    {
        Flight::create([
            'airline' => 'BA',
            'number' => '234',
            'departure_airport' => 'LHR',
            'departure_time' => '09:15:00',
            'arrival_airport' => 'CDG',
            'arrival_time' => '11:00:00',
            'price' => '400.25',
            'departure_date' => '2024-05-28'
        ]);

        Flight::create([
            'airline' => 'AF',
            'number' => '567',
            'departure_airport' => 'CDG',
            'departure_time' => '16:30:00',
            'arrival_airport' => 'AMS',
            'arrival_time' => '17:45:00',
            'price' => '250.75',
            'departure_date' => '2024-06-09'
        ]);
    }
}
