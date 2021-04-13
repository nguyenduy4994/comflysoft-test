<?php

namespace Tests\Feature;

use App\Facades\PeopleService;
use App\Models\People;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_people()
    {
        $data = People::factory()->raw();

        PeopleService::create($data);

        $this->assertDatabaseHas('people', $data);
    }

    public function test_can_update_people()
    {
        People::factory()->count(10)->create();

        $people = People::first();
        $data = People::factory()->raw();

        PeopleService::update($people->id, $data);

        $data['id'] = $people->id;

        $this->assertDatabaseHas('people', $data);
    }
}
