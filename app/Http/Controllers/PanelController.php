<?php

namespace App\Http\Controllers;

use App\Models\Trips;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $tripQuery = Trips::query()->orderBy('created_at','DESC')->get();

        echo '<table cellpadding="0" cellspacing="0" align="center" border="1">
        <tr>
            <th>Origin</th>
            <th>Destination</th>
            <th>Total Spots</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Cancel minutes</th>
            <th>Reservations</th>
        </tr>';
        foreach ($tripQuery as $singleRow){
            echo '<tr>
                    <td>'.$singleRow->origin.'</td>
                    <td>'.$singleRow->destination.'</td>
                    <td>'.$singleRow->total_spots.'</td>
                    <td>'.$singleRow->start_time.'</td>
                    <td>'.$singleRow->end_time.'</td>
                    <td>'.$singleRow->cancel_time.'</td>
                    <td>'.$singleRow->reservation.'</td>
                </tr>';
        }
        echo '</table>';
    }
}
