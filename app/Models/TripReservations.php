<?php

namespace App\Models;

use App\Constant\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
