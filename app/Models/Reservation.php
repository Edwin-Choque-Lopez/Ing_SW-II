<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante

class Reservation extends Model
{
   use SoftDeletes;

    protected $fillable = [
        'client_id',
        'code_order',
        'status_id',
        'admin_notes',
        'total_amount',
        'expiry_date',
    ];

    public function client() { 
        return $this->belongsTo(Client::class, 'client_id', 'id'); 
    }
    public function items() { 
        return $this->hasMany(ReservationItem::class, 'reservation_id', 'id'); 
    }
    public function status() { 
        return $this->belongsTo(StatusReservation::class, 'status_id', 'id'); 
    }
}
