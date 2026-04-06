<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante

class Reservation extends Model
{
   use SoftDeletes;

    protected $fillable = [
        'client_id', 'code_order', 'status', 'subtotal', 'tax_amount', 
        'total_amount', 'admin_notes', 'expiry_date'
    ];

    public function client() { return $this->belongsTo(Client::class); }
    public function items() { return $this->hasMany(ReservationItem::class); }
}
