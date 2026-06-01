<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'name', 
        'description',
        'photo',
        'parent_id'
    ];

    public function parent():BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children():HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products():HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
