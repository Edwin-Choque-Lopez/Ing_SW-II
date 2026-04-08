<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante

class ReservationItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reservation_id',
        'product_id',
        'quantity',
        'unite_price',
        'item_subtotal',
    ];

    public function reservation() { 
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id'); 
    }
    public function product() { 
        return $this->belongsTo(Product::class, 'product_id', 'id'); 
    }
}
