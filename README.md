# Trip Builder

This project was build for **FlightHub Group**. It is a API web service to build and navigate trips for a single passenger 
using criteria such as departure locations, departure dates and arrival locations.

---

.   **[Features](#features)** .
    **[Technical Requirements](#technical-requirements)** .
    **[Build](#build)** .
    **[Usage](#usage)** .
    **[Customize](#customize)** .
    **[Documentation](#documentation)** .
    **[Areas for Improvement](#areas-for-improvement)** .

---

## Features

### Flight and Airport Management
- Easily manage flight, airline, and airport information.
- Search flights just by editing the url.

### API Documentation with Swagger
- Automatic API documentation using Laravel Swagger.
- Easily explore API endpoints and test them directly from the Swagger interface.

### Easy Customization
- Designed with Laravel, allowing easy customization and extension.
- Leverage Laravel's capabilities to develop new features quickly.

### Automated Testing
- Complete suite of automated tests to ensure code quality.
- Uses PHPUnit for unit testing.

### Scalability and Performance
- Designed to scale easily as the number of airlines, airports or flights grow.
- Optimization of database queries and caching for optimal performance.

## Technical Requirements
- Create Web Services to build and navigate trips for a single passenger using criteria such as
  departure locations, departure dates and arrival locations.
- A trip references one or many flights with dates of departure.
- Server-side application MUST be written in PHP.
- The resulting project MUST be version-controlled and hosted online.
- Easy to follow instructions MUST be provided to provision an environment , install and run
  the application locally.
- The following trip types MUST be supported: one-way, round-trip.

### Extra considerations
- The application is deployed online to ease the review process: https://trip-builder.devdensan.com
- The application scales beyond sample data (given on the PDF).
- The application uses data storage provisioned within the environment.
- The application implements automated software tests.
- The application documents Web Services (using Swagger).
- The application allows flights to be restricted to a preferred airline.
- The application supports open-jaw trips and multi-city trips.

## Technologies

- PHP v8.2
- Laravel 11.0
- Composer v2.7.2
- Swagger v8.6

## Build

Pre required:
- PHP v8.2 or higher (check by doing `php -v`).
- Composer v2.2.0 or higher (`composer update` should suffice).
- MySQL or MariaDB database locally installed.

1. First, clone this repo on your folder:

```shell
git clone https://github.com/DenSan83/trip-builder.git
```

2. Next, install your PHP dependencies on the trip-builder folder
```shell
cd trip-builder
composer install
```
3. Make sure php artisan has a safe generated key
```shell
   php artisan key:generate
```

4. Copy and edit the .env file to connect the app to your database
```shell
   cp .env.example .env
   nano .env
```
5. Then, open a CLI, create and populate your database with the tables needed and some examples from the seeders

```shell
php artisan migrate && php artisan db:seed
```
- You will find some entries for Airlines, Airports and Flights on your database.
- Check out the [Customize](#customize) section to modify the files to suit your needs.

6. in a local environment, you will need to create a local server
```shell
php artisan serve
```

## Usage

You can list all entries of Airlines, Airports and Flights from your database with a GET request
```http
GET /api/airlines
GET /api/airports
GET /api/flights
```

Flights can be filtered by airline by adding an *airline* parameter
```http
GET /api/flights?airline=AC
```

### Trip Builder
In order to build a trip, you can chain up to 5 flights in a request. Every request has three parts: a flight date, a 
departure airport and an arrival airport. A request also needs a type (Ex: oneway, round-trip). You can also filter 
flights by an airline, by using the optional parameter `airline`

*Example 1:*
```http
GET /search?seg0_date=2024-06-28&seg0_from=YUL&seg0_to=YVR&type=oneway
```
In this example:
- `seg0_date`: Specifies the departure date for the trip segment. The earliest date can be tomorrow and the latest 
date can be one year from today. Date must be in format YYYY-MM-DD.
- `seg0_from`: Specifies the departure location using a IATA airport code from the database.
- `seg0_to`: Specifies the arrival location using a IATA airport code from the database.
- `type`: Specifies the type of trip. It can be one of these: oneway, roundtrip, openjaws or multicity.

If we add more flights to this trip, `seg0` will need to be replaced by `seg1`, `seg2`, etc.

*Example 2:*
```http
GET /search?seg0_date=2024-06-28&seg0_from=LHR&seg0_to=CDG&seg1_date=2024-07-09&seg1_from=CDG&seg1_to=AMS&seg2_date=2024-07-12&seg2_from=AMS&seg2_to=YYZ&type=multicity
```

In this example, our trip has:
- A first flight: from LHR (London) to CDG (Paris) on 2024-06-28
- A second flight: from CDG (Paris) to AMS (Amsterdam) on 2024-07-09
- A third flight: from AMS (Amsterdam) to YYZ (Toronto) on 2024-07-12
- A type: multicity

You can find more information on the documentation of the API *(website root: '/')*.

Try these examples:
- Filter flights by airline: https://trip-builder.devdensan.com/api/flights?airline=AC 
- Round trip: https://trip-builder.devdensan.com/search?seg0_date=2024-06-15&seg0_from=SYD&seg0_to=YYZ&seg1_date=2024-06-30&seg1_from=YYZ&seg1_to=SYD&type=roundtrip
- Multi-city trip: https://trip-builder.devdensan.com/search?seg0_date=2024-06-28&seg0_from=LHR&seg0_to=CDG&seg1_date=2024-06-09&seg1_from=CDG&seg1_to=AMS&seg2_date=2024-06-12&seg2_from=AMS&seg2_to=YYZ&type=multicity

## Customize

- If you would like to add more trip types, please modify `app/Enums/TripType.php`.
- To add more Airlines, modify `database/seeders/AirlineSeeders.php` before the 5th step of the  [build](#build) section.
- To add more Airports, modify `database/seeders/AirportSeeders.php` before the 5th step of the  [build](#build) section.
- To add more Flights, modify `database/seeders/FlightSeeders.php` before the 5th step of the  [build](#build) section.

## Documentation

- PHP versions: [https://www.php.net/downloads.php](https://www.php.net/downloads.php)
- Composer: [https://getcomposer.org/doc/](https://getcomposer.org/doc/)
- Swagger: [https://swagger.io/docs/](https://swagger.io/docs/)

## Areas for Improvement

- Sort trip listings
- Paginate trip listings
- Allow flights departing and/or arriving in the vicinity of requested locations
- Fill seeds from another API
