<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index(){
        return view('signUp');
    }

    public function signUp(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            'telephone' => 'required',
            'birthdate' => 'required',
            'roleId' => 'required'
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'telephone.required' => 'Nomor telepon harus diisi',
            'birthdate.required' => 'Tanggal lahir harus diisi',
            'roleId.required' => 'Role harus diisi'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telephone = $request->telephone;
        $user->birth_date = $request->birthdate;
        $user->role_id = $request->roleId;

        $user->save();
        
        return redirect('/login')->with('success', 'Akun berhasil dibuat');
    }
}
