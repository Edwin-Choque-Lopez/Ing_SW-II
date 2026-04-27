<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class SettingController extends Controller
{
    public function index()
    {
        $categorias = Category::paginate(5);
        $marcas = Brand::paginate(5);
        return view('system_configuration.index_setting', compact('categorias', 'marcas'));
    }
    public function CreateCategory()
    {
        return view('system_configuration.add_setting');
    }
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'nombre_categoria' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'],
            'descripcion_corta' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'],
        ], [
    // Mensajes específicos por regla
            'nombre_categoria.required' => '¡El nombre de la categoria es obligatorio!',
            'nombre_categoria.regex' => 'El nombre de la categoria contiene caracteres no permitidos.',
            'descripcion_corta.regex' => 'La descripción de la categoria solo permite letras, números y puntos.',
        ]);

        Category::create([
            'name' => $request->nombre_categoria,
            'description_short' => $request->descripcion_corta,
        ]);
        return redirect()->route('setting.index')->with('success', 'Categoría creada exitosamente.');
    }
    public function UpdateCategory(Request $request, $id)
    {
        $request->validate([
            'nombre_categoria' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'],
            'descripcion_corta' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'],
        ], [
            'nombre_categoria.required' => '¡El nombre de la categoria es obligatorio!',
            'nombre_categoria.regex' => 'El nombre de la categoria contiene caracteres no permitidos.',
            'descripcion_corta.regex' => 'La descripción de la categoria solo permite letras, números y puntos.',
        ]);
    
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->nombre_categoria,
            'description_short' => $request->descripcion_corta,
        ]);
        return redirect()->route('setting.index')->with('success', 'Categoría actualizada exitosamente.');
    }
    public function DeleteCategory($id)
    {
        /*$category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('setting.index')->with('success', 'Categoría eliminada exitosamente.');*/
    }
    public function StoreBrand(Request $request)
    {
        $request->validate([
            'nombre_marca' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'
                    ],
            'pais_origen' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ, \s]+$/u'
                 ],
        ],[
            'nombre_marca.required' => '¡El nombre de la marca es obligatorio!',
            'nombre_marca.regex' => 'El nombre de la marca contiene caracteres no permitidos.',
            'pais_origen.required' => '¡El país de origen es obligatorio!',
            'pais_origen.regex' => 'El país de origen solo permite letras.',
        ]);

        Brand::create([
            'name' => $request->nombre_marca,
            'country_origin' => $request->pais_origen,
        ]);
        return redirect()->route('setting.index')->with('success', 'Marca creada exitosamente.');
    }
    public function UpdateBrand(Request $request, $id)
    {
        $request->validate([
            'nombre_marca' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'
                    ],
            'pais_origen' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ, \s]+$/u'
                 ],
        ],[
            'nombre_marca.required' => '¡El nombre de la marca es obligatorio!',
            'nombre_marca.regex' => 'El nombre de la marca contiene caracteres no permitidos.',
            'pais_origen.required' => '¡El país de origen es obligatorio!',
            'pais_origen.regex' => 'El país de origen solo permite letras.',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update([
            'name' => $request->nombre_marca,
            'country_origin' => $request->pais_origen,
        ]);
        return redirect()->route('setting.index')->with('success', 'Marca actualizada exitosamente.');
    }
}
