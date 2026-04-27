<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreProfileController extends Controller
{
    public function index() {
        $datos=StoreProfile::first();
        $perfil=User::where('id',Auth::id())->first();
        return view('profile.profile', compact('perfil','datos'));
    }
}
