<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/search', [TripController::class, 'tripBuilder']);
Route::get('/api/airlines', [AirlineController::class, 'fetchList']);
Route::get('/api/airports', [AirportController::class, 'fetchList']);
Route::get('/api/flights', [FlightController::class, 'fetchList']);
