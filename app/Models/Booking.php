<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'restaurant_id',
        'customer_name',
        'phone',
        'email',
        'booking_date',
        'booking_time',
        'number_of_guests',
        'note',
        'status',
        'qr_code',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}