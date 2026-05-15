<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\StatusProduct;
use App\Models\Category;
use App\Models\Brand;

class ProductsController extends Controller
{
    
    public function index()
    {
        $products = Product::with(['status', 'category', 'brand'])->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::pluck('name','id');
        $categories = Category::whereNotNull('parent_id')->pluck('name','id');
        $statusProducts = StatusProduct::pluck('name','id');
        return view('products.create',compact('brands','categories','statusProducts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'oem' => 'required|string|max:255|unique:products,oem',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status_id' => 'required|exists:status_products,id',
            'compatibility_notes' => 'nullable|string|max:1000',
            'technical_specs' => 'nullable|string|max:1000',
            'price_buy' => 'required|numeric|min:0',
            'price_sell' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'image_main' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $image = $request->file('image_main');
        unset($validated['image_main']);

        $product = Product::create($validated);

        if ($image) {
            $filename = 'PROD' . $product->id . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $filename, 'public');
            $product->update(['image_main' => $path]);
        }

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');

    }
    public function show(string $id)
    {
        $product = Product::with(['status', 'category', 'brand'])->findOrFail($id);
        return response()->json($product);
        //return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::pluck('name','id');
        $categories = Category::whereNotNull('parent_id')->pluck('name','id');
        $statusProducts = StatusProduct::pluck('name','id');
        return view('products.edit', compact('product', 'brands', 'categories', 'statusProducts'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'oem' => 'required|string|max:255|unique:products,oem,' . $id,
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status_id' => 'required|exists:status_products,id',
            'compatibility_notes' => 'nullable|string|max:1000',
            'technical_specs' => 'nullable|string|max:1000',
            'price_buy' => 'required|numeric|min:0',
            'price_sell' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'image_main' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image_main')) {
            $imageFile = $request->file('image_main');
            $filename = 'PROD' . $product->id . '.' . $imageFile->getClientOriginalExtension();

            // Eliminar imagen anterior si existe
            if ($product->image_main && Storage::disk('public')->exists($product->image_main)) {
                Storage::disk('public')->delete($product->image_main);
            }

            $path = $imageFile->storeAs('products', $filename, 'public');
            $validated['image_main'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.show', $product->id)->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Eliminar imagen si existe
        if ($product->image_main && Storage::disk('public')->exists($product->image_main)) {
            Storage::disk('public')->delete($product->image_main);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
