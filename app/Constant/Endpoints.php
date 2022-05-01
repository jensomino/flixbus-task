<?php

namespace App\Constant;

class Endpoints
{
    const TRIP_API_RESOURCE = 'trips';
    const TRIPACTION_RESERVE_POST = 'tripaction/reserve';
    const TRIPACTION_RESERVE_POST_ACTION = 'App\Http\Controllers\TripactionController@reserve';
    const TRIPACTION_CANCEL_POST = 'tripaction/cancel';
    const TRIPACTION_CANCEL_POST_ACTION = 'App\Http\Controllers\TripactionController@cancel';
    const PANEL_INDEX = 'panel';
    const PANEL_INDEX_ACTION = 'App\Http\Controllers\PanelController@index';
}
