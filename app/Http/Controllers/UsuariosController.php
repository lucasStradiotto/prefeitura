<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use App\Models\secretaria;
use App\Models\UserSecretaria;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class UsuariosController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'empresa_id' => 'required',
            'secretaria' => 'required',
            'perfis' => 'required',
        ],[
            'perfis.required' => 'O campo perfil precisa ser informado. Por favor, você pode verificar isso?',
            'empresa_id.required' => 'O campo empresa precisa ser informado. Por favor, você pode verificar isso?',
            'name.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?'
        ]);
        $usuario = User::create([
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'password' => bcrypt(request()->get('password')),
            'empresa_id' => request()->get('empresa_id'),
            'receber_notificacao' => isset($_REQUEST['receber_notificacao']),
        ]);

        $usuario->attachRole(request()->get('perfis'));

        foreach(request()->get('secretaria') as $secretaria)
        {
            UserSecretaria::create([
                'secretaria_id' => $secretaria,
                'user_id' => $usuario->id
            ]);
        }

        return view('home');
    }

    public function create()
    {
        $perfis = Role::select('id', 'display_name')->get();
        $empresas = empresa::all();
        $secretarias = secretaria::orderBy('nome')->get();

        return view('usuarios.create', compact('perfis', 'empresas', 'secretarias'));
    }

}
