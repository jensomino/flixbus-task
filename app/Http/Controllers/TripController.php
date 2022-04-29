<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripFilterSortReq;
use App\Http\Requests\TripReq;
use App\Models\Trips;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpCode;

class TripController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param TripFilterSortReq $request
     * @return JsonResponse
     */
    public function index(TripFilterSortReq $request) : JsonResponse
    {
        $filter = $request->get('filter', null);
        if ($filter != null) {
            $filter = json_decode($filter, true);
        }
        $queryResource = Trips::query();

        $resourceOptions = $this->parseResourceOptions();
        $total = Trips::select('id')->get()->count();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
        $parsedData = $this->parseData($list, $resourceOptions);

        Log::info('[TripController][index] the trips has been listed', $request->all());

        $response = ['total' => $total, 'per_page' => $resourceOptions['limit'], 'data' => $parsedData];
        return new JsonResponse( $response );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TripReq $request
     * @return JsonResponse
     */
    public function store(TripReq $request) : JsonResponse
    {
        try {
            $inputs = $request->all();
            $trip = Trips::create($inputs);
        } catch (\Exception $err) {
            Log::error('[TripController][store] throw exception',$request->toArray());
            return new JsonResponse(['data'=> ['status' => 'failed','message' => $err->getMessage()] ],HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[TripController][store] the subscription plan has been stored');
        return new JsonResponse( ['message' => 'trip has been created' , 'details' => $trip ], HttpCode::HTTP_CREATED );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        try{
            $trip = Trips::findOrFail($id);
        } catch (\Exception $err) {
            Log::error('[TripController][show] throw exception');
            return new JsonResponse(['data'=> ['status' => 'failed','message' => $err->getMessage()] ],HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[TripController][show] the trip has been showed', $trip->toArray());
        return new JsonResponse( ['data' => $trip] ,HttpCode::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TripReq $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TripReq $request, int $id) : JsonResponse
    {
        try{
            $trip = Trips::findOrFail($id);
            $trip->update($request->all());
        } catch (\Exception $err) {
            Log::error('[TripController][update] throw exception');
            return new JsonResponse(['data'=> ['status' => 'failed','message' => $err->getMessage()] ],HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[TripController][update] the trip has been updated', $trip->toArray());
        return new JsonResponse( ['data' => $trip] ,HttpCode::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id) : JsonResponse
    {
        try{
            $trip = Trips::findOrFail($id)->delete();
        } catch (\Exception $err) {
            Log::error('[TripController][delete] throw exception');
            return new JsonResponse(['data'=> ['status' => 'failed','message' => $err->getMessage()] ],HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        Log::info('[TripController][delete] the trip has been deleted', ["id" => $id]);
        return new JsonResponse( ['data' => $trip] ,HttpCode::HTTP_OK);
    }
}
