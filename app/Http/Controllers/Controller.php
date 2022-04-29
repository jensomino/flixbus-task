<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

class Controller extends LaravelController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, EloquentBuilderTrait;
}
