<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;

class HomeController extends Controller
{
    use ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desenvolvedor = Auth::user()->hasRole('desenvolvedor');
        return view('home', compact('desenvolvedor'));
    }

    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
            return redirect()->back()->with("error", "A senha atual não confere com a senha informada. Por favor tente novamente.");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
        //Current password and new password are same
            return redirect()->back()->with("error", "A nova senha não pode ser igual a senha atual. Por favor escolha uma senha diferente.");
        }
        $validatedData = $this->validate($request,[
            'current-password' => 'required',
            'new-password' => 'required|string|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", "Senha alterada com sucesso!");
    }

}
