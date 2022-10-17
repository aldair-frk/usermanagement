<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Person;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\Middleware\AuthenticateSession;

class LoginController extends Controller
{
    public function index() {
        // if(Auth::check()){
        //     return redirect('/dashboard');
        // }
        return view('index');
    }

    public function loginAuth(LoginRequest $request){
        $credentials = $request->getCredentials();
        if(Auth::attempt($credentials)){
            $data = Person::select('names', 'is_region', 'is_province', 'is_district')
                    ->where('dni', $request->username) ->get();
            echo $data;
            $request->session()->regenerate();
            // para borrar los datos
            $request->session()->flush();
            return $request->session()->all();
            // return redirect()->intended('/dashboard');
        }

        // return redirect('/');
        throw ValidationException::withMessages([
            'username' => 'Usuario o Contraseña no valido'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
