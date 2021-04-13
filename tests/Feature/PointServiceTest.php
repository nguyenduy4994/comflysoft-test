<?php

namespace Tests\Feature;

use App\Facades\PointService;
use App\Models\People;
use App\Models\Point;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PointServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_point()
    {
        // Create some people
        People::factory()->count(10)->create();

        $person = People::first();
        $raw = Point::factory()->raw();
        $data = [
            'datetime' => $raw['datetime'],
            'lat' => $raw['position']->getLat(),
            'long' => $raw['position']->getLng(),
        ];

        $point = PointService::create($person->id, $data);

        $this->assertTrue(
            ($point->people_id == $person->id) &&
            ($point->position->getLat() == $data['lat']) &&
            ($point->position->getLng() == $data['long']) &&
            ($point->datetime == $data['datetime'])
        );
    }
}
