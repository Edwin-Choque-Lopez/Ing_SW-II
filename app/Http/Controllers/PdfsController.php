<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reservation;
use App\Models\StoreProfile;

class PdfsController extends Controller
{
    public function pdfreservation($code) {
        $institution = StoreProfile::first();
        $reservation = Reservation::with(['user', 'status', 'reservationItems.product'])
            ->where('code_order', $code)
            ->first();
        if (!$reservation) {
            abort(404, 'Reserva no encontrada');
        }
        $pdf = Pdf::loadView('pdfs.reservation', compact('institution', 'reservation', 'code'));
    
        //return $pdf->stream('reserva-' . $code . '.pdf'); 
        return $pdf->download('reserva-' . $code . '.pdf');
    }
    public function showpdfreservation($code) {
        $institution = StoreProfile::first();
        $reservation = Reservation::with(['user', 'status', 'reservationItems.product'])
            ->where('code_order', $code)
            ->first();
        if (!$reservation) {
            abort(404, 'Reserva no encontrada');
        }
        $pdf = Pdf::loadView('pdfs.reservation', compact('institution', 'reservation', 'code'));
    
        return $pdf->stream('reserva-' . $code . '.pdf'); 
        //return $pdf->download('reserva-' . $code . '.pdf');
    }
    //return response()->json($institution);

}
