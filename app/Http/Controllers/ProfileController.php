<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileData(): \Illuminate\Contracts\View\View
    {
        return view('company.profile');
    }

    public function dataEditing(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'ci' => 'required|string|max:10|min:7|regex:/^[0-9 \s]+$/|unique:users,ci,' . $id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'ci.required' => 'La cédula es requerida.',
            'ci.unique' => 'Esta cédula ya está registrada.',
            'ci.regex'=>'La cédula solo debe tener numeros',
            'ci.max'=>'La cédula no debe tener mas de 10 digitos',
            'ci.min'=>'La cédula no debe tener menos de 7 digitos',
            'name.required' => 'El nombre es requerido.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo debe ser válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.mimes' => 'La imagen debe ser de tipo JPEG, PNG, JPG o GIF.',
            'photo.max' => 'La imagen no debe exceder 2MB.',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoName = $validated['ci'] . '.' . $photoFile->getClientOriginalExtension();
            $photoPath = $photoFile->storeAs('photos', $photoName, 'public');
            $validated['photo'] = $photoPath;
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Datos actualizados exitosamente.');
    }
}
