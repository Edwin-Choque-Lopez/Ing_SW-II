<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Relations\HasMany;
class Brand extends Model
{
    use SoftDeletes;
    protected $table = 'brands';
    protected $fillable = [
        'name', 
        'country_origin',
    ];
    public function products():HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
