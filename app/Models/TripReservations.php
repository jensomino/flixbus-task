<?php

namespace App\Models;

use App\Constant\Schema;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TripReservations extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * @var string
     */
    public $table = Schema::DB_TRIP_RESERVATION;

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string[]
     */
    protected $fillable = [
        'trip_id',
        'passenger_name',
        'selected_spots'
    ];

    public function trip()
    {
        return $this->belongsTo(Trips::class);
    }

    /**
     * @param int $tripId
     * @param int $tripTotalSpot
     * @param string $passengerName
     * @param int $selectedSpots
     * @return mixed
     */
    public static function checkCapacityAndReserve(int $tripId,int $tripTotalSpot,string $passengerName,int $selectedSpots)
    {
        $result = DB::transaction(function () use ($tripId,$tripTotalSpot,$passengerName,$selectedSpots){
            $reserve = DB::table(Schema::DB_TRIP_RESERVATION)
                ->selectRaw(DB::raw('SUM(selected_spots) AS total'))
                ->groupBy()
                ->where('trip_id','=',$tripId)
                ->whereNull('deleted_at')
                ->get();

            $totalReserved = $reserve[0]->total;
            $wantedReserve = $totalReserved + $selectedSpots;
            if ($tripTotalSpot >= $wantedReserve){
                DB::table(Schema::DB_TRIP_RESERVATION)->insert([
                    'trip_id' => $tripId,
                    'passenger_name' => $passengerName,
                    'selected_spots' => $selectedSpots,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return true;
            }
            return false;
        });
        return $result;
    }

    /**
     * @param int $tripId
     * @param string $passengerName
     * @return mixed
     */
    public static function deleteReservation(int $tripId,string $passengerName){
        return static::query()->where('trip_id','=', $tripId)
            ->where('passenger_name', '=', $passengerName)
            ->delete();
    }
}
