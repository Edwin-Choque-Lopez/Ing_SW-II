<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProfile;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Models\Reservation;
use App\Models\ReservationItem;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    public function start(){
        $brands=Brand::select('name','logo')->get();
        $categories = Category::select('name','description','photo')->whereNull('parent_id')->get();
        $profile = User::first();
        $institution = StoreProfile::first();
        //return response()->json($institution);
        return view('welcome', compact('profile','brands','categories','institution'));

    }
    public function catalog(){
        $profile = User::first();
        $products = Product::select('id','oem','name','price_sell','image_main')->paginate(9);
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();
        $user_id = Auth::id();
        $code = Reservation::select('id','code_order')->where('user_id',$user_id)->where('booking',false)->first();
        if ($code) {
            $count = ReservationItem::where('reservation_id', $code->id)->count();
        } else {
            $count = 0; 
        }
        //return response()->json($code);
        //$categories = Category::select('name')->whereNotNull('parent_id')->get();
        return view('reservation.catalog',compact('profile','products','categories','code','count'));
    }
    public function filter(string $id){
        $profile = User::first();
        $products = Product::select('id', 'oem', 'name', 'price_sell', 'image_main')
            ->where('category_id', $id) // Corregido de 'categorie_id' a 'category_id'
            ->paginate(9);
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();
        $user_id = Auth::id();
        $code = Reservation::select('id','code_order')->where('user_id',$user_id)->where('booking',false)->first();
        if ($code) {
            $count = ReservationItem::where('reservation_id', $code->id)->count();
        } else {
            $count = 0; 
        }
        //$categories = Category::select('name')->whereNotNull('parent_id')->get();
        return view('reservation.catalog',compact('profile','products','categories','code','count'));
    }
    public function infoproduct(string $id){
        $profile = User::first();
        $product = Product::with(['status', 'category', 'brand'])->findOrFail($id);
        $user_id = Auth::id();
        $code = Reservation::select('code_order')->where('user_id',$user_id)->where('booking',false)->first();
        return view('reservation.showproduct',compact('profile','product','code'));
        //return response()->json($product); 
    }
    public function storeReservation(Request $request)
    {
        $code = $request->code_order;
        if ($code)
        {
            $id_reservation = Reservation::where('code_order',$code)->first()?->id;
            //return response()->json($id_reservation);

        }else{
            $count = Reservation::count(); 
            $nextNumber = $count + 1;
            $code_order = 'CAI-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            $reservation = Reservation::create([
                'user_id' => $request->input('user_id'),
                'code_order' => $code_order,
                'status_id' => 1, 
                'notes' => null,
                'total' => $request->input('product-price'),
                'booking' => false,
                'expiry_date' => now()->addDays(7), 
            ]); 

            $id_reservation = $reservation->id; 
            //return response()->json($id_reservation);
        }

        $quantity = (int) $request->input('product-quantity', 0);
        $price    = (float) $request->input('product-price', 0);

        $subtotal = $quantity * $price;
        ReservationItem::create([
            'reservation_id' => $id_reservation,
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('product-quantity'),
            'unite_price' => $request->input('product-price'),
            'item_subtotal' => $subtotal,
        ]);
        
        return redirect()->route('catalog.products');
    }
    public function cart(Request $request){
        $profile = User::first();
        $code=$request->input('code_order');
        $shopping = Reservation::with(['user', 'status', 'reservationItems.product'])
        ->where('code_order', $code)
        ->first();
        //return response()->json($shopping);
        return view('reservation.shoppingcart',compact('profile','shopping'));
    }
    public function itemDelete(Request $request,$id){
        ReservationItem::destroy($id);
        $code_order = $request->code_order;
        return redirect()->route('shopping.cart', ['code_order' => $code_order]);
        //return response()->json($request);
    }
    public function reserve(Request $request){
        $reserve = Reservation::where('code_order', $request->input('code_order'))->firstOrFail();

        $reserve->total = $request->input('total_reserva');
        $reserve->booking = true;       // Marcamos como reservado/confirmado
        $reserve->status_id = 2;        // Cambiamos el estado (ej: 2 = "Reserva Confirmada" o "Pagada")
        
        // 4. Guardar los cambios en la base de datos
        $reserve->save();

        // 5. Redireccionar al catálogo o a una vista de éxito con un mensaje amigable
        return redirect()->route('catalog.products');
    }
}
