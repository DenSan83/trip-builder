<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = ['airline', 'number', 'departure_airport', 'departure_time', 'arrival_airport', 'arrival_time', 'price'];
}
