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

    /**
     * Filter by datetime from start and after a number of minutes
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Carbon $startDateTime
     * @param integer $minutes
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDateTimeBetween($query, $startDateTime, $minutes)
    {
        return $query
                ->where('datetime', '>=', $startDateTime->toDateTimeString())
                ->where('datetime', '<=', $startDateTime->addMinutes($minutes)->toDateTimeString());
    }

    /**
     * Filter not ID
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotId($query, $id)
    {
        return $query->where($this->getKeyName(), '<>', $id);
    }

    /**
     * The person owner of this point
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(People::class, 'people_id');
    }
}
