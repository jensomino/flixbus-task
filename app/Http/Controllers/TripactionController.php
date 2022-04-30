<?php

namespace App\Http\Controllers;

use App\Exceptions\ReservationException;
use App\Http\Requests\CancelReq;
use App\Http\Requests\ReserveReq;
use App\Models\TripReservations;
use App\Models\Trips;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpCode;

class TripactionController extends Controller
{
    /**
     * @param ReserveReq $req
     * @return JsonResponse
     * @throws ReservationException
     */
    public function reserve(ReserveReq $req) : JsonResponse
    {
        $origin = $req->get('origin',null);
        $destination = $req->get('destination',null);
        $passengerName = $req->get('passenger_name',null);
        $selectedSpots = (int) $req->get('selected_spots',null);
        try{
            $trip = Trips::findWithCondition($origin,$destination);
            Log::info('[TripactionController][reserve] active trip has been found',$trip->toArray());

            $tripAction = TripReservations::checkCapacityAndReserve((int) $trip['id'],(int) $trip['total_spots'], $passengerName,$selectedSpots);
            if ($tripAction){
                Log::info('[TripactionController][reserve] the reservation has been done',$req->toArray());
                return new JsonResponse( ['status' => 'success','data' => $req->toArray()] ,HttpCode::HTTP_CREATED);
            } else {
                Log::error('[TripactionController][reserve] ran out of reservation capacity',$req->toArray());
                return new JsonResponse( ['status' => 'failed','message' => 'there is not enough spot to reserve'] ,HttpCode::HTTP_UNPROCESSABLE_ENTITY);
            }
        } catch (\Exception $err){
            Log::error('[TripactionController][reserve] there is not any trip with this condition',$req->toArray());
            throw new ReservationException($err->getMessage(),$err->getCode());
        }
    }

    /**
     * @param CancelReq $req
     * @return JsonResponse
     * @throws ReservationException
     */
    public function cancel(CancelReq $req) : JsonResponse
    {
        $origin = $req->get('origin',null);
        $destination = $req->get('destination',null);
        $passengerName = $req->get('passenger_name',null);

        try{
            $trip = Trips::findWithCondition($origin,$destination);
            TripReservations::deleteReservation((int) $trip['id'],$passengerName);
            Log::info('[TripactionController][cancel] the trip has been canceled',$req->toArray());

            return new JsonResponse( ['status' => 'success', 'message' => 'the trip has been canceled','data' => $req->toArray()] ,HttpCode::HTTP_OK);
        } catch (\Exception $err){
            Log::error('[TripactionController][cancel] there is not any trip with this condition',$req->toArray());
            throw new ReservationException($err->getMessage(),$err->getCode());
        }
    }
}
