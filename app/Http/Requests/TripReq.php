<?php

namespace App\Http\Requests;


class TripReq extends BaseApiFormReqs
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'total_spots' => 'required|numeric|gte:1|lte:99'
        ];
    }
}
