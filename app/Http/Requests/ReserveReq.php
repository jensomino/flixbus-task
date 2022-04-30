<?php

namespace App\Http\Requests;


class ReserveReq extends BaseApiFormReqs
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'origin' => 'required',
            'destination' => 'required',
            'passenger_name' => 'required',
            'selected_spots' => 'numeric|gte:1',
        ];
    }
}
