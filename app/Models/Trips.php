<?php

namespace App\Models;

use App\Constant\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trips extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    public $table = Schema::DB_TRIPS;

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string[]
     */
    protected $fillable = [
        'origin',
        'destination',
        'total_spots',
        'start_time',
        'end_time',
        'cancel_time',
    ];

}
