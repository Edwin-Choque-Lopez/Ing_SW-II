<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class role extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];

    public function user():HasOne
    {
        return $this->hasOne(User::class, 'role_id','id');
    }

}
