<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users= User::all(); 
        return view('Panel.index', compact('users'));
    }
    public function create (){
        return view('Users.create');
    }

    public function saveuser (Request $request){
        user::create($request->all());
        return redirect ()->route('user.index')->with('success', 'Creado correctamente'); 
    }
    public function show($id){
        
        $user = User::find($id);
        //dd($user);
        return view('panel.show', compact('user'));
    }

    public function edit(User $user){

        return view('Users.edit', compact('user')); 

    }

    public function update (Request $request, $id){
        $user=User::findOrFail($id);
        $data = $request->only('username','province_name','district_name','is_super','is_admin');
        if(trim($request->password)=='')
        {
            $data=$request->except('password');
        }
        else{
            $data=$request->all();
            $data['password']=bcrypt($request->password);
            
        }
        $user->update($data);
        return redirect ()->route('user.index')->with('success', 'Actualizado Correctamente'); 
    }

    public function destroy (User $user){
        $user->delete();
        return back()->with('success', 'Usuario eliminado'); 

    }
}


