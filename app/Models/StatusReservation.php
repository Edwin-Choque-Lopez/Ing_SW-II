<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusReservation extends Model
{
    use softDeletes;
    protected $table = 'status_reservations';
    protected $fillable = [
        'name',
        'description',
    ];
    public function reservations():HasMany { 
        return $this->hasMany(Reservation::class, 'status_id', 'id'); 
    }
}
