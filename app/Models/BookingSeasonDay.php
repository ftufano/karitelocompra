<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSeasonDay extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'booking_season_day';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_season_id',
        'type',
        'day_date',
        'quota'
    ];

    /**
     * Get the season that owns the day.
     */
    public function booking_season()
    {
        return $this->belongsTo(BookingSeason::class);
    }
}
