<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'oem',
        'name',
        'category_id',
        'brand_id',
        'status_id',
        'technical_notes',
        'price_buy',
        'price_sell',
        'stock',
        'min_stock',
        'image_main',
    ];

    /*protected $casts = [
        'technical_specs' => 'array', // Convierte el JSON a Array automáticamente
    ];*/

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusProduct::class, 'status_id', 'id');
    }
    public function ReservationItems(): HasMany
    {
        return $this->hasMany(ReservationItem::class, 'product_id', 'id');
    }
}
