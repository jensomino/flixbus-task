<?php

namespace App\Constant;

class Endpoints
{
    const TRIP_API_RESOURCE = 'trips';
    const TRIPACTION_RESERVE_POST = 'tripaction/reserve';
    const TRIPACTION_RESERVE_POST_ACTION = 'App\Http\Controllers\TripactionController@reserve';
    const TRIPACTION_CANCEL_POST = 'tripaction/cancel';
    const TRIPACTION_CANCEL_POST_ACTION = 'App\Http\Controllers\TripActionController@cancel';
}
