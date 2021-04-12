<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $spatialFields = [
        'position',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'datetime' => 'datetime',
    ];

    public function scopeDateTimeBetween($query, $startDateTime, $minutes)
    {
        return $query
                ->where('datetime', '>=', $startDateTime->toDateTimeString())
                ->where('datetime', '<=', $startDateTime->addMinutes($minutes)->toDateTimeString());
    }

    public function scopeNotId($query, $id)
    {
        return $query->where($this->getKeyName(), '<>', $id);
    }

    public function person()
    {
        return $this->belongsTo(People::class, 'people_id');
    }
}
