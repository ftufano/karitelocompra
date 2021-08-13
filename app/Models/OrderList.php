<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'booking_season_day_id',
        'booking_season_day_booking_season_id',
        'items_total',
        'list_total',
        'commision_percentage',
        'order_commision',
        'order_total'
    ];

    /**
     * Get the day where the order list is booked and the user that belongs this order list.
     */
    public function booking_season()
    {
        return $this->belongsTo(BookingSeasonDay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
