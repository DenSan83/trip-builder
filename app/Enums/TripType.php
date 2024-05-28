<?php

namespace App\Enums;

enum TripType: string
{
    case ONEWAY = 'oneway';
    case ROUNDTRIP = 'roundtrip';
    case OPENJAWS = 'openjaws';
    case MULTICITY = 'multicity';
}
