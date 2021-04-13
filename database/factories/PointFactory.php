<?php

namespace Database\Factories;

use App\Models\Point;
use App\Services\PointService;
use Grimzy\LaravelMysqlSpatial\Types\Point as TypesPoint;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Point::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position' => new TypesPoint($this->faker->latitude(10.770, 10.779), $this->faker->longitude(106.680, 106.689), PointService::SRID_WGS84),
            'datetime' => $this->faker->dateTimeBetween('-60 minutes'),
        ];
    }
}
