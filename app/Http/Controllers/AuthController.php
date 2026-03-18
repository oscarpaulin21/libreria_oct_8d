<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;        

class AuthController extends Controller
{
    //Metodo para regresar vista del formulario
    public function registerForm()
    {
        return view('auth.register');
    }

    //Metodo para guardar la información en la BD
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);
           
        //Iniciar sesión de forma automatica
        Auth::login($user);

        return redirect()->route('libros.index');
    }

    //metodo para regresar vista de inicio de sesion
    public function loginForm(){
        return view('auth.login');
    }

    //Metodo para verificar el inicio de sesion
    public function login(Request $request){

        //Validar los datos que se obtienen del formulario
        $data = $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //se realiza una validacion para generar la sesion
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            //Generar la sesion
        
            //redireccionar al user a qualquier ruta del sistema
            return redirect()->route('libros.index');
        }

        return back()->withErrors([
            'email' => 'Los datos no son correctas',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
    //cierre de sesion
    Auth::logout();

    //cierre de credenciales en sesiones
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/acceso');
    }
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}