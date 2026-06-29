<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;

class ClientsController extends Controller
{
    public function index()
    {
        $clients=User::where('role_id',2)->paginate(10);
        return view('clients.index',compact('clients'));
    }
    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'ci'        => 'required|string|min:7|max:10|regex:/^[0-9\s]+$/|unique:users,ci,',
            'name' => 'required|string|max:255|regex:/^[0-9a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/',
            'phone'     => 'required|string|min:8|max:10|regex:/^[0-9\s]+$/',
            'email'     => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'ci.required'        => 'La cédula de identidad es obligatoria.',
            'ci.string'          => 'La cédula debe ser un formato de texto válido.',
            'ci.min'             => 'La cédula debe tener al menos 7 caracteres.',
            'ci.max'             => 'La cédula no puede tener más de 10 caracteres.',
            'ci.unique'          => 'Este número de cédula ya se encuentra registrado.',
            'ci.regex'           => 'La cedula solo puede contener números y espacios.',
            'name.required' => 'El nombre completo es obligatorio.',
            'name.string'   => 'El nombre completo debe ser un formato de texto válido.',
            'name.max'      => 'El nombre completo no puede exceder los 255 caracteres.',
            'name.regex'    => 'El nombre completo solo puede contener letras, números y espacios.',
            'phone.required' => 'El telefono es requerido.',
            'phone.string'       => 'El teléfono debe ser un formato de texto válido.',
            'phone.min'          => 'El teléfono debe tener al menos 8 dígitos.',
            'phone.max'          => 'El teléfono no puede tener más de 10 dígitos.',
            'phone.regex'        => 'El teléfono solo puede contener números y espacios.',
            'email.required' => 'El correo es obligaatorio.',
            'email.email'        => 'El correo electrónico debe ser una dirección válida.',
            'email.max'          => 'El correo electrónico no puede exceder los 255 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' =>'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);


        User::create($validated);

        return redirect()->route('clients.index')->with('icon','success')->with('title','Exito')->with('message', 'Cliente registrado correctamente.');
    }
    Public function updateClient(Request $request, $id)
    {
        $client = User::findOrFail($id);
        $validated = $request->validate([
            'ci'        => 'required|string|min:7|max:10|regex:/^[0-9\s]+$/|unique:users,ci,'.$id,
            'name' => 'required|string|max:255|regex:/^[0-9a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/',
            'phone'     => 'required|string|min:8|max:10|regex:/^[0-9\s]+$/',
            'email'     => 'required|email|max:255|unique:users,email,'.$id,
        ], [
            'ci.required'        => 'La cédula de identidad es obligatoria.',
            'ci.string'          => 'La cédula debe ser un formato de texto válido.',
            'ci.min'             => 'La cédula debe tener al menos 7 caracteres.',
            'ci.max'             => 'La cédula no puede tener más de 10 caracteres.',
            'ci.unique'          => 'Este número de cédula ya se encuentra registrado.',
            'ci.regex'           => 'La cedula solo puede contener números y espacios.',
            'name.required' => 'El nombre completo es obligatorio.',
            'name.string'   => 'El nombre completo debe ser un formato de texto válido.',
            'name.max'      => 'El nombre completo no puede exceder los 255 caracteres.',
            'name.regex'    => 'El nombre completo solo puede contener letras, números y espacios.',
            'phone.string'       => 'El teléfono debe ser un formato de texto válido.',
            'phone.min'          => 'El teléfono debe tener al menos 8 dígitos.',
            'phone.max'          => 'El teléfono no puede tener más de 10 dígitos.',
            'email.unique'          => 'Este correo ya se encuentra registrado.',
            'email.required' => 'El correo es obligaatorio.',
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
        $client = User::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')
            ->with('icon', 'success')
            ->with('title', 'Éxito')
            ->with('message', 'Cliente eliminado correctamente.');
    }
}
