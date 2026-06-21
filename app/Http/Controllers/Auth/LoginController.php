<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Manejo de la petición HTTP
use Illuminate\Support\Facades\Auth; // Motor de Autenticación de Laravel
use Illuminate\Validation\ValidationException; // Control de errores de validación

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Procesa la petición de inicio de sesión directamente en este archivo.
     * Sobrescribe por completo el flujo oculto del Trait.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // 1. Validar los datos del formulario directamente aquí
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // 2. Controlar la seguridad contra fuerza bruta (Throttling)
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // 3. Obtener las credenciales e intentar el inicio de sesión (Auth::attempt)
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember'); 

        if (Auth::attempt($credentials, $remember)) {
            
            // MEDIDA DE SEGURIDAD: Regenerar la sesión del servidor para evitar hackeos
            $request->session()->regenerate();

            // Borrar el historial de intentos fallidos de esta IP
            $this->clearLoginAttempts($request);

            // Obtener el usuario que acaba de iniciar sesión
            $user = Auth::user();
            
            if ($user->role_id == 1) {
                return redirect()->route('home');
            } elseif ($user->role_id == 2) {
                return redirect()->route('catalog.products');
                //return response()->json(['message' => 'Biemvenido cliente'],200);
            }

            // Retornar la respuesta JSON con el mensaje personalizado
        }

        // 4. Si el login falla, incrementar el contador de intentos erróneos
        $this->incrementLoginAttempts($request);

        // Devolver el error visual al formulario HTML en Blade
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}

