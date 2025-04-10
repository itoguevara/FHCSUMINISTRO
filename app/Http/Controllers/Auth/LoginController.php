<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Models\Configuracion\User;
use App\Models\Configuracion\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    public function register(Request $request)
    {

    }
    public function login(Request $request)
    {

        $data_usuario = Usuario::where('id', $request->email)->first();
        if ($data_usuario !== null && $user !== null) {
            if ($user->rol_id !== null) {
                if ($data_usuario->id === $user->id) {
                    if ($user->status == 1) {
                        if ($data_usuario->pass === md5($request->password)) {
                            Auth::login($user);
                            $request->session()->regenerate();
                            return redirect()->intended('/');
                        }

                        throw ValidationException::withMessages([
                            'password' => 'Contraseña Incorrecta'
                        ]);
                    }

                    throw ValidationException::withMessages([
                        'email' => 'Usuario inactivo'
                    ]);
                }
                throw ValidationException::withMessages([
                    'email' => __('auth.failed')
                ]);
            } else {
                throw ValidationException::withMessages([
                    'error' => 'Usuario Sin Rol Asignado, Comuniquese con su Administrador de Sistemas'
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'error' => 'Datos Incorrectos, Favor Verifique'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
