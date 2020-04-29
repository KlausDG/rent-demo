<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::get();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(Request $request)
    {
        $user = $request->isMethod('put') ? User::findOrFail($request->id) : new User;

        if ($request->input('old_password')) {
            if (!password_verify($request->input('old_password'), $user->password)) {
                return ['error' => "A senha antiga está errada!"];
            }
        }

        if ($request->input('name')) {
            $user->name = $request->input('name');
        }

        if ($request->input('username')) {
            $user->username = $request->input('username');
        }

        if ($request->input('email')) {
            $user->email = $request->input('email');
        } 
        
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        
        $user->role = 2;
        $user->filial_id = 1;
        // dd($user);

        if ($user->save()) {
            return $user;
        }

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return $user;
        }
    }
}
