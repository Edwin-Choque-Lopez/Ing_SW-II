<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante

class StatusReservation extends Model
{
    use softDeletes;
    protected $fillable = [
        'name',
        'description',
    ];
    public function reservations() { 
        return $this->hasMany(Reservation::class, 'status_id', 'id'); 
    }
}
