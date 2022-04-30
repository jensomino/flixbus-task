<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TripApiTest extends TestCase
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
    public function test_define_trip()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++){
            $response = Http::post('http://localhost/api/trips',[
                'origin' => $faker->city(),
                'destination' => $faker->city(),
                'total_spots' => rand(3,15),
                'start_time' => date('Y-m-d'),
                'end_time' => date('Y-m-d',strtotime(sprintf('%s day',rand(1,80)))),
                'cancel_time' => 60
            ]);
            $this->assertEquals(201,$response->status());
        }
    }

    public function test_define_trip_with_invalid_payload()
    {
        $faker = \Faker\Factory::create();

        $response = Http::post('http://localhost/api/trips',[
            'origin' => $faker->city(),
            'destination' => $faker->city(),
            'start_time' => date('Y-m-d'),
            'end_time' => date('Y-m-d',strtotime(sprintf('%s day',rand(1,80)))),
            'cancel_time' => 60
        ]);
        $this->assertEquals(422,$response->status());
    }

}
