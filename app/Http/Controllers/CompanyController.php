<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\StoreProfile;

class CompanyController extends Controller
{
    public function InstitutionData()
    {
        $storeProfile = StoreProfile::first();

        return view('company.company', compact('storeProfile'));
    }

    public function dataEditing(Request $request, $id)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255|regex:/^[0-9a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/',
            'nit'            => 'required|string|max:255|regex:/^[0-9\s]+$/',
            'address'        => 'required|string|max:500|regex:/^[0-9a-zA-ZáéíóúñÁÉÍÓÚÑ#.,\-\s]+$/',
            'city'           => 'nullable|string|max:255|regex:/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', // Removido números para ciudades
            'phone_whatsapp' => 'required|string|max:50|regex:/^[0-9\s+]+$/', // Añadido el símbolo '+' para códigos de país
            'email'          => 'nullable|email|max:255', // Coma corregida
            'footer_text'    => 'nullable|string|max:1000|regex:/^[0-9a-zA-ZáéíóúñÁÉÍÓÚÑ(),.\s]+$/', // Añadido max
            'logo_path'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Mensajes para 'name'
            'name.required'           => 'El nombre de la tienda es obligatorio.',
            'name.string'             => 'El nombre debe ser un formato de texto válido.',
            'name.max'                => 'El nombre no puede superar los 255 caracteres.',
            'name.regex'              => 'El nombre solo puede contener letras, números y espacios.',

            // Mensajes para 'nit'
            'nit.required'            => 'El NIT es obligatorio.',
            'nit.string'              => 'El NIT debe ser un formato de texto válido.',
            'nit.max'                 => 'El NIT no puede superar los 255 caracteres.',
            'nit.regex'               => 'El NIT solo puede contener números y espacios.',

            // Mensajes para 'address'
            'address.required'        => 'La dirección es obligatoria.',
            'address.string'          => 'La dirección debe ser un formato de texto válido.',
            'address.max'             => 'La dirección no puede superar los 500 caracteres.',
            'address.regex'           => 'La dirección contiene caracteres no permitidos (use letras, números, #, -, puntos o comas).',

            // Mensajes para 'city'
            'city.string'             => 'La ciudad debe ser un formato de texto válido.',
            'city.max'                => 'La ciudad no puede superar los 255 caracteres.',
            'city.regex'              => 'La ciudad solo puede contener letras y espacios.',

            // Mensajes para 'phone_whatsapp'
            'phone_whatsapp.required' => 'El número de teléfono/WhatsApp es obligatorio.',
            'phone_whatsapp.string'   => 'El teléfono debe ser un formato de texto válido.',
            'phone_whatsapp.max'      => 'El teléfono no puede superar los 50 caracteres.',
            'phone_whatsapp.regex'    => 'El teléfono solo puede contener números, espacios o el símbolo "+".',

            // Mensajes para 'email'
            'email.email'             => 'Debe ingresar un correo electrónico válido.',
            'email.max'               => 'El correo electrónico no puede superar los 255 caracteres.',

            // Mensajes para 'footer_text'
            'footer_text.string'      => 'El texto de pie de página debe ser un formato de texto válido.',
            'footer_text.max'         => 'El texto de pie de página no puede superar los 1000 caracteres.',
            'footer_text.regex'       => 'El pie de página contiene caracteres no permitidos.',

            // Mensajes para 'logo_path'
            'logo_path.image'         => 'El archivo seleccionado debe ser una imagen.',
            'logo_path.mimes'         => 'La imagen debe tener un formato válido: jpeg, png, jpg o gif.',
            'logo_path.max'           => 'La imagen del logo no debe pesar más de 2 MB (2048 KB).',
        ]);


        $storeProfile = StoreProfile::findOrFail($id);

        if ($request->hasFile('logo_path')) {
            $logoFile = $request->file('logo_path');
            $nit = $validated['nit'];
            $folder = "store_profiles/{$nit}";
            $filename = $nit . '.' . $logoFile->getClientOriginalExtension();

            // Eliminar logo anterior si existe
            if ($storeProfile->logo_path && Storage::disk('public')->exists($storeProfile->logo_path)) {
                Storage::disk('public')->delete($storeProfile->logo_path);
            }

            $path = $logoFile->storeAs($folder, $filename, 'public');
            $validated['logo_path'] = $path;
        }

        $storeProfile->update($validated);

        return redirect()->route('company')->with('success', 'Datos del perfil guardados correctamente.');
    }
}
