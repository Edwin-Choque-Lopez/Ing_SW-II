<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusProduct extends Model
{
    use SoftDeletes;
    protected $table = 'status_products';
    protected $fillable = [
        'name',
        'description',
    ];
    public function products(): HasMany
    { 
        return $this->hasMany(Product::class, 'status_id', 'id'); 
    }
}
