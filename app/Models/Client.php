<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use SoftDeletes;
    protected $table = 'clients';
    protected $fillable = [
        'ci',
        'full_name',
        'phone',
        'email',
    ];

    public function reservations():HasMany
    { 
        return $this->hasMany(Reservation::class,'client_id', 'id'); 
    }

}
