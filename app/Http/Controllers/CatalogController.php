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
        /*  product_id	"5"
            product-title	"Componente Mecánico de Motor"
            product-price	"230.00"
            user_id	"2"
            code_order	"CAI-00005"
            product-quantity	"4"
            submit	"addtocard" 
        */
        // 1. VALIDACIÓN DE LOS DATOS DE ENTRADA
        $request->validate([
            'product_id'       => 'required|integer|exists:products,id',
            'product_price'    => 'required|numeric|min:0',
            'user_id'          => 'required|integer|exists:users,id',
            'product_quantity' => 'required|integer|gt:0',
            'submit'           => 'required|string|in:addtocard',
        ], [
            'product_id.required'       => 'El producto es obligatorio.',
            'product_id.integer'        => 'El identificador del producto debe ser un número entero.',
            'product_id.exists'         => 'El producto seleccionado no existe en nuestro inventario.',
            'product_price.required'    => 'El precio es obligatorio.',
            'product_price.numeric'     => 'El precio debe ser un valor numérico.',          
            'user_id.required'          => 'El usuario es obligatorio.',
            'user_id.exists'            => 'El cliente especificado no está registrado en el sistema.',                     
            'product_quantity.required' => 'La cantidad es obligatoria.',
            'product_quantity.integer'  => 'La cantidad debe ser un número entero.',
            'product_quantity.gt'       => 'La cantidad ingresada debe ser un número positivo mayor a cero.',
            'product_quantity.min'      => 'Debe agregar al menos 1 repuesto al carrito.',
            'submit.in'                 => 'La acción solicitada no es válida.',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->product_quantity) {
            return redirect()->back()
                ->with('message', "Solo quedan {$product->stock} unidades disponibles de este producto.");
        }

        $code = $request->code_order;
        if ($code)
        {
            $id_reservation = Reservation::where('code_order',$code)->first()?->id;
        }else{
            $count = Reservation::count(); 
            $nextNumber = $count + 1;
            $code_order = 'CAI-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            $reservation = Reservation::create([
                'user_id' => $request->input('user_id'),
                'code_order' => $code_order,
                'status_id'   => 1,
                'notes' => null,
                'total' => $request->input('product-price'),
                'booking' => false,
                'expiry_date' => now()->addDays(7), 
            ]); 
            $id_reservation = $reservation->id; 
        }

        $quantity = (int) $request->input('product_quantity', 0);
        $price    = (float) $request->input('product_price', 0);

        $subtotal = $quantity * $price;
        ReservationItem::create([
            'reservation_id' => $id_reservation,
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('product_quantity'),
            'unite_price' => $request->input('product_price'),
            'item_subtotal' => $subtotal,
        ]);
        $product->decrement('stock', $quantity);
        
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
        $item = ReservationItem::findOrFail($id);
        $cant = $item->quantity; 
        $product_id = $item->product_id;
        $product = Product::findOrFail($product_id);
        $product->increment('stock', $cant);   
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
