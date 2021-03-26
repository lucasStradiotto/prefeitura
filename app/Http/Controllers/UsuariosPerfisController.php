<?php

namespace App\Http\Controllers;

use App\Models\IconePerfilWeb;
use App\Models\IconeWeb;
use App\Models\ItemPerfilWeb;
use App\Models\RoleUser;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UsuariosPerfisController extends Controller
{
    public function index()
    {
        $title = 'Atrelar perfis aos usuários';
        $usuarios = User::orderBy('name')->get();

        return view('usuariosPerfis.index', compact('title', 'usuarios'));
    }

    public function getRoles()
    {
        $roles = Role::select('display_name', 'id')->orderBy('display_name')->get();

        return json_encode($roles);
    }

    public function getRolesUserChecked()
    {
        $user = request()->get('user');
        $checked = RoleUser::where('user_id', '=', $user)->pluck('role_id');
        return json_encode($checked);
    }

    public function store(Request $request)
    {
        $title = "Atrelar perfis aos usuários";
        $usuarios = User::orderBy('name')->get();

        $user_id = $request->get('user_id');
        $roles = $request->get('roles');

        //verifica se o usuario possui perfil atrelado
        if (count(RoleUser::where('user_id', '=', $user_id)->get()) > 0)
        {
            //se possui perfis, apaga todos os relacionados a este usuario que ja estavam no banco
            $delete = RoleUser::where('user_id', '=', $user_id)->delete();
            if (!$delete)
                return redirect()->back()->with(['errors' => 'Falha ao Limpar Perfis']);
        }
        $toAdd['user_id'] = $user_id;
        //verifica se vieram perfis do form
        if (count($roles) > 0)
        {
            //adiciona os perfis que vieram do form para este usuario
            foreach ($roles as $role)
            {
                $toAdd['role_id'] = $role;
                $insert = RoleUser::insert($toAdd);
                if (!$insert)
                    return redirect()->back()->with(['errors' => 'Falha ao Inserir Perfil']);
            }
        }
        return view('usuariosPerfis.index', compact('title', 'usuarios'));
    }
}
