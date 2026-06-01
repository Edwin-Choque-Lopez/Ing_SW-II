<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProfile;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;

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
        
        //$categories = Category::select('name')->whereNotNull('parent_id')->get();
        return view('reservation.catalog',compact('profile','products','categories'));
    }
    public function filter(string $id){
        $profile = User::first();
       $products = Product::select('id', 'oem', 'name', 'price_sell', 'image_main')
    ->where('category_id', $id) // Corregido de 'categorie_id' a 'category_id'
    ->paginate(9);
        $categories = Category::whereNull('parent_id')
    ->with('children')
    ->get();
        //$categories = Category::select('name')->whereNotNull('parent_id')->get();
        return view('reservation.catalog',compact('profile','products','categories'));
    }
    public function infoproduct(string $id){
        $profile = User::first();
        $product = Product::with(['status', 'category', 'brand'])->findOrFail($id);
        return view('reservation.showproduct',compact('profile','product'));
        //return response()->json($product); 
    }
}
