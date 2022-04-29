<?php

namespace App\Http\Controllers;

use App\Constant\Schema;
use App\Http\Requests\TripFilterSortReq;
use App\Http\Requests\TripReq;
use App\Models\Trips;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $queryResource->orderBy(Schema::DB_TRIPS. '.created_at','DESC');

        $resourceOptions = $this->parseResourceOptions();
        $total = Trips::select('id')->get()->count();
        $this->applyResourceOptions($queryResource,$resourceOptions);
        $list = $queryResource->get();
        $parsedData = $this->parseData($list, $resourceOptions);

        Log::info('[TripController][index] the trips has been listed');

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
        $response = [];
        return new JsonResponse( $response, HttpCode::HTTP_ACCEPTED );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
