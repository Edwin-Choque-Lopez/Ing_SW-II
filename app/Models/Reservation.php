<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
   use SoftDeletes;
   protected $table = 'reservations';
    protected $fillable = [
        'user_id',
        'code_order',
        'status_id',
        'notes',
        'total',
        'expiry_date',
        'booking',
    ];

    public function user(): BelongsTo
    { 
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
    public function ReservationItems(): HasMany
    { 
        return $this->hasMany(ReservationItem::class, 'reservation_id', 'id'); 
    }
    public function status(): BelongsTo
    { 
        return $this->belongsTo(StatusReservation::class, 'status_id', 'id'); 
    }
}
