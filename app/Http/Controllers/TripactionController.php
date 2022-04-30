<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelReq;
use App\Http\Requests\ReserveReq;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpCode;

class TripactionController extends Controller
{
    public function reserve(ReserveReq $req) : JsonResponse
    {
        dd($req->all());
        Log::info('[TripactionController][reserve] the trip has been deleted');
        return new JsonResponse( ['data' => '$trip'] ,HttpCode::HTTP_OK);
    }

    public function cancel(CancelReq $req) : JsonResponse
    {
        dd($req->all());

        Log::info('[TripactionController][cancel] the trip has been deleted');
        return new JsonResponse( ['data' => '$trip'] ,HttpCode::HTTP_OK);
    }
}
