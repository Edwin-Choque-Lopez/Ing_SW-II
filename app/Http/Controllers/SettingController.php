<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class SettingController extends Controller
{
    public function index()
    {
        $categorias = Category::paginate(5);
        return view('system_configuration.index_setting', compact('categorias'));
    }
    public function CreateCategory()
    {
        return view('system_configuration.add_setting');
    }
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'name' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'
                    ],
            'cat_description' => [
                        'nullable',
                        'string',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'
                 ],
        ]);

        Category::create([
            'name' => $request->name,
            'description_short' => $request->cat_description,
        ]);
        return redirect()->route('setting.index')->with('success', 'Categoría creada exitosamente.');
    }
    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('system_configuration.editcategorie', compact('category'));
    }
    public function UpdateCategory(Request $request, $id)
    {
        return redirect()->route('setting.index')->with('success', 'Categoría creada exitosamente.');
    
        /*$request->validate([
            'name' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'
                    ],
            'cat_description' => [
                        'nullable',
                        'string',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. \s]+$/u'
                 ],
        ]);
        

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description_short' => $request->cat_description,
        ]);
        return redirect()->route('setting.index')->with('success', 'Categoría actualizada exitosamente.');
    */}
    public function DeleteCategory($id)
    {
        /*$category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('setting.index')->with('success', 'Categoría eliminada exitosamente.');*/
    }
}
