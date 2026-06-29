<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\StatusReservation;
use App\Models\User;
use App\Models\StoreProfile;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    public function search(Request $request)
    {
        $user_id = Auth::id();
        $profile = User::first();
        $institution = StoreProfile::first();
        $reservation = Reservation::with(['user', 'status', 'ReservationItems.product'])
            ->where('code_order', $request->search_code)
            ->where('booking', true)
            ->where('user_id',$user_id)
            ->first();

        return view('showreservation.search', compact('reservation', 'profile', 'institution'));
    }
    public function index($id){
        $reservations = Reservation::with(['user', 'status'])->where('status_id',$id)->where('booking', true)->paginate(10);
        $namestatus = StatusReservation::select('name')->where('id',$id)->first();
        return view('showreservation.index',compact('reservations','namestatus'));
        //return response()->json($namestatus);
    }
    public function show($id){
        $reservation = Reservation::with(['user', 'status', 'ReservationItems.product'])
            ->where('id', $id)
            ->where('booking', true)
            ->firstOrFail();

        return view('showreservation.show', compact('reservation'));
        //return response()->json($reservation);
    }
    public function edit($id)
    {
        $reservation = Reservation::with(['user', 'status', 'ReservationItems.product'])
            ->where('id', $id)
            ->where('booking', true)
            ->firstOrFail();

        $statusOptions = StatusReservation::pluck('name', 'id');

        return view('showreservation.edit', compact('reservation', 'statusOptions'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_id' => 'required|exists:status_reservations,id',
            'notes' => 'nullable|string|max:2000',
        ]);

        $reservation = Reservation::where('id', $id)
            ->where('booking', true)
            ->firstOrFail();

        $reservation->status_id = $validated['status_id'];
        $reservation->notes = $validated['notes'] ?? $reservation->notes;
        $reservation->save();

        return redirect()->route('reservation.show', $reservation->id)
            ->with('success', 'Estado y notas de la reserva actualizados correctamente.');
    }
}
