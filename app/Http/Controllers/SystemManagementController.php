<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Brand;
class SystemManagementController extends Controller
{
    public function index()
    {
        $parentCategories = Category::whereNull('parent_id')->pluck('name', 'id'); // Fetch parent categories
        $categories = Category::paginate(5);

        $brands = Brand::paginate(5);
        return view('system_management.catalog', compact('parentCategories', 'categories', 'brands'));
    }

    public function storeCategory(Request $request)
    {
        //return response()->json($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description_short' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'parent_id' => 'nullable|exists:categories,id',
        ],[
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description_short.string' => 'La descripción corta debe ser una cadena de texto.',
            'description_short.max' => 'La descripción corta no puede exceder los 255 caracteres.',
            'description_short.regex' => 'La descripción corta solo puede contener letras, números, espacios y los caracteres .,()%',

            'parent_id.exists' => 'La categoría padre seleccionada no existe.',
        ]);
        $category = new Category();
        $category->name = $request->input('name');
        $category->description_short = $request->input('description_short');
        $category->parent_id = $request->input('parent_id');
        $category->save();  
        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Categoría creada')->with('message', 'Los datos de la categoría se han guardado exitosamente.');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id.'|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description_short' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'parent_id' => 'nullable|exists:categories,id',
        ],[
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description_short.string' => 'La descripción corta debe ser una cadena de texto.',
            'description_short.max' => 'La descripción corta no puede exceder los 255 caracteres.',
            'description_short.regex' => 'La descripción corta solo puede contener letras, números, espacios y los caracteres .,()%',

            'parent_id.exists' => 'La categoría padre seleccionada no existe.',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->description_short = $request->input('description_short');
        $category->parent_id = $request->input('parent_id');
        $category->save();
        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Categoría actualizada')->with('message', 'Los datos de la categoría se han  actualizado exitosamente.');    
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Categoría eliminada')->with('message', 'La categoría se ha eliminado exitosamente.');
    }

    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'country_origin' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
        ],[
            'name.required' => 'El nombre de la marca es obligatorio.',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto.',
            'name.max' => 'El nombre de la marca no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una marca con ese nombre.',
            'name.regex' => 'El nombre de la marca solo puede contener letras, números, espacios y los caracteres .,()%',

            'country_origin.string' => 'El país de origen debe ser una cadena de texto.',
            'country_origin.max' => 'El país de origen no puede exceder los 255 caracteres.',
            'country_origin.regex' => 'El país de origen solo puede contener letras, números, espacios y los caracteres .,()%',
        ]);
        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->country_origin = $request->input('country_origin');
        $brand->save();  
        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Marca creada')->with('message', 'Los datos de la marca se han guardado exitosamente.');
    }
    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,'.$id.'|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'country_origin' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
        ],[
            'name.required' => 'El nombre de la marca es obligatorio.',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto.',
            'name.max' => 'El nombre de la marca no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una marca con ese nombre.',
            'name.regex' => 'El nombre de la marca solo puede contener letras, números, espacios y los caracteres .,()%',

            'country_origin.string' => 'El país de origen debe ser una cadena de texto.',
            'country_origin.max' => 'El país de origen no puede exceder los 255 caracteres.',
            'country_origin.regex' => 'El país de origen solo puede contener letras, números, espacios y los caracteres .,()%',
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->input('name');
        $brand->country_origin = $request->input('country_origin');
        $brand->save();
        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Marca actualizada')->with('message', 'Los datos de la marca se han  actualizado exitosamente.');    
    }   
    public function destroyBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Marca eliminada')->with('message', 'La marca se ha eliminado exitosamente.');
    }
}

