<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante
class StoreProfile extends Model
{
    use softDeletes; 
    protected $table = 'store_profiles';
    protected $fillable = [
        'name',
        'nit',
        'address',
        'city',
        'phone_whatsapp',
        'email',
        'logo_path',
        'description',
    ];
}
