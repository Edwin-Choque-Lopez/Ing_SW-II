<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante

class Product extends Model
{
        use SoftDeletes;

        protected $fillable = [
        'oem', 
        'name', 
        'category_id', 
        'brand_id', 
        'compatibility_notes', 
        'technical_specs', 
        'price_buy', 
        'price_sell', 
        'stock', 
        'min_stock', 
        'image_main', 
        'status',
        'technical_specs',
     ];

        /*protected $casts = [
            'technical_specs' => 'array', // Convierte el JSON a Array automáticamente
        ];*/

        public function category() {
            return $this->belongsTo(Category::class);
        }

        public function brand() {
            return $this->belongsTo(Brand::class);
        }
}
