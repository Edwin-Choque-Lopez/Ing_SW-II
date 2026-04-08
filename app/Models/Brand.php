<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante
class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 
        'country_origin',
    ];
    public function products() {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
