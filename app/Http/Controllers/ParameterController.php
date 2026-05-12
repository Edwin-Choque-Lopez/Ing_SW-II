<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusProduct;
use App\Models\StatusReservation;
use App\Models\Brand;

class ParameterController extends Controller
{
    public function index()
    {
        $productStatuses = StatusProduct::paginate(5);
        $reservationStatuses = StatusReservation::paginate(5);

        $brands = Brand::paginate(5);
        return view('system_management.parameters', compact('productStatuses', 'reservationStatuses', 'brands'));
    }

    public function storeProductStatus(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255|unique:categories,name|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
        ],[
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description.string' => 'La descripción corta debe ser una cadena de texto.',
            'description.max' => 'La descripción corta no puede exceder los 255 caracteres.',
            'description.regex' => 'La descripción corta solo puede contener letras, números, espacios y los caracteres .,()%',

        ]);
        $productstatus = new StatusProduct();
        $productstatus->name = $request->input('name');
        $productstatus->description = $request->input('description');
        $productstatus->save();  
        return redirect()->route('parameters.index')->with('icon', 'success')->with('title', 'Estado creada')->with('message', 'Los datos del nuevo estado del producto se han guardado exitosamente.');
    }

    public function updateProductStatus(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id.'|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
        ],[
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description.string' => 'La descripción corta debe ser una cadena de texto.',
            'description.max' => 'La descripción corta no puede exceder los 255 caracteres.',
            'description.regex' => 'La descripción corta solo puede contener letras, números, espacios y los caracteres .,()%',

        ]);
        $productstatus = StatusProduct::findOrFail($id);
        $productstatus->name = $request->input('name');
        $productstatus->description = $request->input('description');
        $productstatus->save();  
        return redirect()->route('parameters.index')->with('icon', 'success')->with('title', 'Estado Actualizado')->with('message', 'Los datos del estado del producto se actualizaron');
    }

    public function destroyProductStatus($id)
    {
        $productstatus = StatusProduct::findOrFail($id);
        $productstatus->delete();
        return redirect()->route('parameters.index')->with('icon', 'success')->with('title', 'Estado eliminado')->with('message', 'El estado de producto fue eliminado');
    }

    public function storeReservationStatus(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
        ],[
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description.string' => 'La descripción corta debe ser una cadena de texto.',
            'description.max' => 'La descripción corta no puede exceder los 255 caracteres.',
            'description.regex' => 'La descripción corta solo puede contener letras, números, espacios y los caracteres .,()%',

        ]);
        $productstatus = new StatusReservation();
        $productstatus->name = $request->input('name');
        $productstatus->description = $request->input('description');
        $productstatus->save();  
        return redirect()->route('parameters.index')->with('icon', 'success')->with('title', 'Estado creado')->with('message', 'Nuevo estado de reservas guardada con exito.');
    }

    public function updateReservationStatus(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id.'|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
            'description' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,()% \s]+$/',
        ],[
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'name.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'name.regex' => 'El nombre de la categoría solo puede contener letras, números, espacios y los caracteres .,()%',

            'description.string' => 'La descripción corta debe ser una cadena de texto.',
            'description.max' => 'La descripción corta no puede exceder los 255 caracteres.',
            'description.regex' => 'La descripción corta solo puede contener letras, números, espacios y los caracteres .,()%',

        ]);
        $productstatus = StatusReservation::findOrFail($id);
        $productstatus->name = $request->input('name');
        $productstatus->description = $request->input('description');
        $productstatus->save();  
        return redirect()->route('parameters.index')->with('icon', 'success')->with('title', 'Estado Actualizado')->with('message', 'Los datos del estado de reservación se actualizaron');
    }

    public function destroyReservationStatus($id)
    {
        $productstatus = StatusReservation::findOrFail($id);
        $productstatus->delete();
        return redirect()->route('parameters.index')->with('icon', 'success')->with('title', 'Estado eliminado')->with('message', 'El estado de reservacioón fue eliminado');
    }
}
