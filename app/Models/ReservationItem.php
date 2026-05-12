<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationItem extends Model
{
    use SoftDeletes;
    protected $table = 'reservation_items';
    protected $fillable = [
        'reservation_id',
        'product_id',
        'quantity',
        'unite_price',
        'item_subtotal',
    ];

    public function reservation(): BelongsTo
    { 
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id'); 
    }
    public function product(): BelongsTo
    { 
        return $this->belongsTo(Product::class, 'product_id', 'id'); 
    }
}
