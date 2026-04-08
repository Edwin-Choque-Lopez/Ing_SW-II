<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante

class StatusProduct extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
    ];
    public function products() { 
        return $this->hasMany(Product::class, 'status_id', 'id'); 
    }
}
