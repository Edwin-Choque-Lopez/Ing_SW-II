<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Reservation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalClients = User::count();
        $totalProducts = Product::count();
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::with(['user', 'status'])
            ->where('status_id', 1)
            ->latest('created_at')
            ->get();
        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')
            ->latest('updated_at')
            ->get();

        return view('home', compact(
            'totalClients',
            'totalProducts',
            'totalReservations',
            'pendingReservations',
            'lowStockProducts'
        ));
    }
}
