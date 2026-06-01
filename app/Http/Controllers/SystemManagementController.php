<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Brand;
use Illuminate\Support\Facades\Storage; // No olvides importar Storage arriba de tu controlador
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
        // 1. Validar los datos (añadimos la regla para la foto y asignamos a $validated)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description' => 'nullable|string|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'parent_id' => 'nullable|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validación recomendada para la foto
        ], [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.regex' => 'La descripción solo puede contener letras, números, espacios y los caracteres .,()%',

            'parent_id.exists' => 'La categoría padre seleccionada no existe.',
            
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.mimes' => 'La foto debe ser en formato jpeg, png, jpg o webp.',
            'photo.max' => 'La foto no debe pesar más de 2MB.',
        ]);

        // 2. Crear y guardar primero el registro de la categoría para generar el ID
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->parent_id = $request->input('parent_id');
        $category->save(); // Aquí el objeto $category ya obtiene su ID autoincremental

        // 3. Verificar si se envió una foto
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            
            // Nombramos el archivo usando el ID que acabamos de generar en la base de datos
            $photoName = $category->id . '.' . $photoFile->getClientOriginalExtension();
            
            // Guardamos la foto en el disco público
            $photoPath = $photoFile->storeAs('categories', $photoName, 'public');
            
            // Actualizamos el campo photo en el modelo y guardamos nuevamente
            $category->photo = $photoPath;
            $category->save();
        }

        // Puedes retornar una respuesta de éxito o redirección aquí
        //return response()->json(['message' => 'Categoría creada con éxito', 'data' => $category], 201);

        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Categoría creada')->with('message', 'Los datos de la categoría se han guardado exitosamente.');
    }

    public function updateCategory(Request $request, $id)
    {
        // 1. Validar los datos incluyendo la foto
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id.'|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description' => 'nullable|string|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/', // Asegúrate que coincida con tu input
            'parent_id' => 'nullable|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validación para la foto
        ], [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.regex' => 'La descripción solo puede contener letras, números, espacios y los caracteres .,()%',

            'parent_id.exists' => 'La categoría padre seleccionada no existe.',
            
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.mimes' => 'La foto debe ser en formato jpeg, png, jpg o webp.',
            'photo.max' => 'La foto no debe pesar más de 2MB.',
        ]);

        // 2. Buscar el registro existente
        $category = Category::findOrFail($id);

        // 3. Procesar la foto si se envió una nueva
        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior del disco público si ya existía una
            if ($category->photo && Storage::disk('public')->exists($category->photo)) {
                Storage::disk('public')->delete($category->photo);
            }

            $photoFile = $request->file('photo');
            
            // Nombramos el archivo con el ID actual del registro
            $photoName = $category->id . '.' . $photoFile->getClientOriginalExtension();
            
            // Guardamos la nueva foto en el almacenamiento público
            $photoPath = $photoFile->storeAs('categories', $photoName, 'public');
            
            // Asignamos la nueva ruta al modelo
            $category->photo = $photoPath;
        }

        // 4. Actualizar los demás campos del modelo
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->parent_id = $request->input('parent_id');

        // 5. Guardar todos los cambios
        $category->save();

        // Puedes retornar una respuesta de éxito o redirección aquí
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],[
            'name.required' => 'El nombre de la marca es obligatorio.',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto.',
            'name.max' => 'El nombre de la marca no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una marca con ese nombre.',
            'name.regex' => 'El nombre de la marca solo puede contener letras, números, espacios y los caracteres .,()%',

            'country_origin.string' => 'El país de origen debe ser una cadena de texto.',
            'country_origin.max' => 'El país de origen no puede exceder los 255 caracteres.',
            'country_origin.regex' => 'El país de origen solo puede contener letras, números, espacios y los caracteres .,()%',

            'logo.image' => 'El archivo debe ser una imagen.',
            'logo.mimes' => 'El logo debe ser en formato jpeg, png, jpg o webp.',
            'logo.max' => 'El logo no debe pesar más de 2MB.',
        ]);
        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->country_origin = $request->input('country_origin');
        $brand->save();  
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            
            // Nombramos el archivo usando el ID que acabamos de generar en la base de datos
            $logoName = $brand->id . '.' . $logoFile->getClientOriginalExtension();
            
            // Guardamos la foto en el disco público
            $logoPath = $logoFile->storeAs('brands', $logoName, 'public');
            
            // Actualizamos el campo logo en el modelo y guardamos nuevamente
            $brand->logo = $logoPath;
            $brand->save();
        }
        return redirect()->route('systemManagement.index')->with('icon', 'success')->with('title', 'Marca creada')->with('message', 'Los datos de la marca se han guardado exitosamente.');
    }
    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,'.$id.'|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'country_origin' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],[
            'name.required' => 'El nombre de la marca es obligatorio.',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto.',
            'name.max' => 'El nombre de la marca no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una marca con ese nombre.',
            'name.regex' => 'El nombre de la marca solo puede contener letras, números, espacios y los caracteres .,()%',

            'country_origin.string' => 'El país de origen debe ser una cadena de texto.',
            'country_origin.max' => 'El país de origen no puede exceder los 255 caracteres.',
            'country_origin.regex' => 'El país de origen solo puede contener letras, números, espacios y los caracteres .,()%',

            'logo.image' => 'El archivo debe ser una imagen.',
            'logo.mimes' => 'El logo debe ser en formato jpeg, png, jpg o webp.',
            'logo.max' => 'El logo no debe pesar más de 2MB.',
        ]);

        $brand = Brand::findOrFail($id);

        // 3. Procesar la foto si se envió una nueva
        if ($request->hasFile('logo')) {
            // Eliminar la foto anterior del disco público si ya existía una
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }

            $logoFile = $request->file('logo');
            
            // Nombramos el archivo con el ID actual del registro
            $logoName = $brand->id . '.' . $logoFile->getClientOriginalExtension();
            
            // Guardamos la nueva foto en el almacenamiento público
            $logoPath = $logoFile->storeAs('brands', $logoName, 'public');
            
            // Asignamos la nueva ruta al modelo
            $brand->logo = $logoPath;
        }

        // 4. Actualizar los demás campos del modelo
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

