<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('system_configuration.index_setting');
    }
    public function create()
    {
        return view('system_configuration.add_setting');
    }
    public function CategoriesStore(Request $request)
    {
        $request->validate([
            'name' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/u'
                    ],
            'cat_description' => [
                        'nullable',
                        'string',
                        'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/u'
                 ],
        ]);


        // Aquí puedes guardar la categoría en la base de datos
        // Por ejemplo:
        // Category::create([
        //     'name' => $request->name,
        //     'technical_specs' => $request->technical_specs,
        // ]);

        //return redirect()->route('setting.index')->with('success', 'Categoría creada exitosamente.');
    }
}
