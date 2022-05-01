<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ReserveTest extends TestCase
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function test_task_example1()
    {
        $faker = \Faker\Factory::create();
        $origin = $faker->city();
        $destination = $faker->city();

        $trip_response = Http::post('http://localhost/api/trips',[
            'origin' => $origin,
            'destination' => $destination,
            'total_spots' => 10,
            'start_time' => date('Y-m-d'),
            'end_time' => date('Y-m-d',strtotime(sprintf('%s day',1))),
            'cancel_time' => 60
        ]);
        $this->assertEquals(201,$trip_response->status());

        $john_reserve = Http::post('http://localhost/api/tripaction/reserve/',[
            'origin' => $origin,
            'destination' => $destination,
            'selected_spots' => 2,
            'passenger_name' => 'John',
        ]);
        $this->assertEquals(201,$john_reserve->status());

        $jane_reserve = Http::post('http://localhost/api/tripaction/reserve/',[
            'origin' => $origin,
            'destination' => $destination,
            'selected_spots' => 8,
            'passenger_name' => 'Jane',
        ]);
        $this->assertEquals(201,$john_reserve->status());

        $ronald_reserve = Http::post('http://localhost/api/tripaction/reserve/',[
            'origin' => $origin,
            'destination' => $destination,
            'selected_spots' => 1,
            'passenger_name' => 'Ronald',
        ]);
        $this->assertEquals(422,$ronald_reserve->status());
    }

    public function test_task_example2()
    {
        $faker = \Faker\Factory::create();
        $origin = $faker->city();
        $destination = $faker->city();

        $trip_response = Http::post('http://localhost/api/trips',[
            'origin' => $origin,
            'destination' => $destination,
            'total_spots' => 10,
            'start_time' => date('Y-m-d'),
            'end_time' => date('Y-m-d',strtotime(sprintf('%s day',1))),
            'cancel_time' => 60
        ]);
        $this->assertEquals(201,$trip_response->status());

        $john_reserve = Http::post('http://localhost/api/tripaction/reserve/',[
            'origin' => $origin,
            'destination' => $destination,
            'selected_spots' => 8,
            'passenger_name' => 'John',
        ]);
        $this->assertEquals(201,$john_reserve->status());

        $jane_reserve = Http::post('http://localhost/api/tripaction/reserve/',[
            'origin' => $origin,
            'destination' => $destination,
            'selected_spots' => 2,
            'passenger_name' => 'Jane',
        ]);
        $this->assertEquals(201,$jane_reserve->status());

        $jane_cancel = Http::post('http://localhost/api/tripaction/cancel/',[
            'origin' => $origin,
            'destination' => $destination,
            'passenger_name' => 'Jane',
        ]);
        $this->assertEquals(200,$jane_cancel->status());

        $ronald_reserve = Http::post('http://localhost/api/tripaction/reserve/',[
            'origin' => $origin,
            'destination' => $destination,
            'selected_spots' => 3,
            'passenger_name' => 'Ronald',
        ]);
        $this->assertEquals(422,$ronald_reserve->status());

        $daniel_reserve = Http::post('http://localhost/api/tripaction/reserve/',[
            'origin' => $origin,
            'destination' => $destination,
            'selected_spots' => 1,
            'passenger_name' => 'Daniel',
        ]);
        $this->assertEquals(201,$daniel_reserve->status());
    }

}
