<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante

class Client extends Model
{
    use SoftDeletes;
    protected $fillable = ['ci', 'full_name', 'phone', 'email', 'genero'];

    public function reservations() { return $this->hasMany(Reservation::class); }

}
