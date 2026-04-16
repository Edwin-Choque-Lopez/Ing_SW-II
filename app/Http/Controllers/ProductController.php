<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.addproduct');
    }
    public function store(Request $request)
    {
        // Validar y guardar el producto
        $request->validate([
            'oem' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'compatibility_notes' => 'nullable|string',
            'technical_specs' => 'nullable|string',
            'price_buy' => 'required|numeric|min:0',
            'price_sell' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'image_main' => 'nullable|string',
            'status' => 'required|in:disponible,agotado,descontinuado'
        ]);

            // Agrega más reglas de validación según tus necesidades
        // $request->validate([...]);
        // Product::create($request->all());
        return response()->json($request->all());
        //return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }
}
