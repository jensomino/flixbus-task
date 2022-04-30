<?php

namespace App\Models;

use App\Constant\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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

    /**
     * @param string $origin
     * @param string $destination
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public static function findWithCondition(string $origin,string $destination){
        $query = static::query()
            ->where('origin','=',$origin)
            ->where('destination','=',$destination)
            ->where('start_time', '<=', Carbon::now())
            ->where('end_time', '>=', Carbon::now())
            ->get();
        if ($query->count() == 0) {
            throw new ModelNotFoundException('not found');
        } else {
         return $query[0];
        }
    }
}
