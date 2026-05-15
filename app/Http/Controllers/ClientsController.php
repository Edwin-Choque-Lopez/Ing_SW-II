<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientsController extends Controller
{
    public function index()
    {
        $clients=Client::paginate(10);
        return view('clients.index',compact('clients'));
    }
    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'ci'        => 'required|string|min:7|max:10|regex:/^[0-9\s]+$/|unique:clients,ci,',
            'full_name' => 'required|string|max:255|regex:/^[0-9a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/',
            'phone'     => 'nullable|string|min:8|max:10|regex:/^[0-9\s]+$/',
            'email'     => 'nullable|email|max:255',
        ], [
            'ci.required'        => 'La cédula de identidad es obligatoria.',
            'ci.string'          => 'La cédula debe ser un formato de texto válido.',
            'ci.min'             => 'La cédula debe tener al menos 7 caracteres.',
            'ci.max'             => 'La cédula no puede tener más de 10 caracteres.',
            'ci.unique'          => 'Este número de cédula ya se encuentra registrado.',
            'ci.regex'           => 'La cedula solo puede contener números y espacios.',
            'full_name.required' => 'El nombre completo es obligatorio.',
            'full_name.string'   => 'El nombre completo debe ser un formato de texto válido.',
            'full_name.max'      => 'El nombre completo no puede exceder los 255 caracteres.',
            'full_name.regex'    => 'El nombre completo solo puede contener letras, números y espacios.',
            'phone.string'       => 'El teléfono debe ser un formato de texto válido.',
            'phone.min'          => 'El teléfono debe tener al menos 8 dígitos.',
            'phone.max'          => 'El teléfono no puede tener más de 10 dígitos.',
            'phone.regex'        => 'El teléfono solo puede contener números y espacios.',
            'email.email'        => 'El correo electrónico debe ser una dirección válida.',
            'email.max'          => 'El correo electrónico no puede exceder los 255 caracteres.',
        ]);


        Client::create($validated);

        return redirect()->route('clients.index')->with('icon','success')->with('title','Exito')->with('message', 'Cliente registrado correctamente.');
    }
    Public function updateClient(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $validated = $request->validate([
            'ci'        => 'required|string|min:7|max:10|regex:/^[0-9\s]+$/|unique:clients,ci,'.$id,
            'full_name' => 'required|string|max:255|regex:/^[0-9a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/',
            'phone'     => 'nullable|string|min:8|max:10|regex:/^[0-9\s]+$/',
            'email'     => 'nullable|email|max:255',
        ], [
            'ci.required'        => 'La cédula de identidad es obligatoria.',
            'ci.string'          => 'La cédula debe ser un formato de texto válido.',
            'ci.min'             => 'La cédula debe tener al menos 7 caracteres.',
            'ci.max'             => 'La cédula no puede tener más de 10 caracteres.',
            'ci.unique'          => 'Este número de cédula ya se encuentra registrado.',
            'ci.regex'           => 'La cedula solo puede contener números y espacios.',
            'full_name.required' => 'El nombre completo es obligatorio.',
            'full_name.string'   => 'El nombre completo debe ser un formato de texto válido.',
            'full_name.max'      => 'El nombre completo no puede exceder los 255 caracteres.',
            'full_name.regex'    => 'El nombre completo solo puede contener letras, números y espacios.',
            'phone.string'       => 'El teléfono debe ser un formato de texto válido.',
            'phone.min'          => 'El teléfono debe tener al menos 8 dígitos.',
            'phone.max'          => 'El teléfono no puede tener más de 10 dígitos.',
            'phone.regex'        => 'El teléfono solo puede contener números y espacios.',
            'email.email'        => 'El correo electrónico debe ser una dirección válida.',
            'email.max'          => 'El correo electrónico no puede exceder los 255 caracteres.',
        ]);
        
        $client->update($validated);
        return redirect()->route('clients.index')
            ->with('icon', 'success')
            ->with('title', 'Éxito')
            ->with('message', 'Cliente actualizado correctamente.');
    }
    public function clientDestroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')
            ->with('icon', 'success')
            ->with('title', 'Éxito')
            ->with('message', 'Cliente eliminado correctamente.');
    }
}
