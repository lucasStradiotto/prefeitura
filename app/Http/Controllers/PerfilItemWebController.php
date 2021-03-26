<?php

namespace App\Http\Controllers;

use App\Models\IconePerfilWeb;
use App\Models\IconeWeb;
use App\Models\ItemWeb;
use App\Models\ItemPerfilWeb;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PerfilItemWebController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Atrelar Item ao Perfil";
        $perfis = Role::orderBy('display_name')->get();

        return view('perfilItemWeb.index', compact('title', 'perfis'));
    }

    public function getIcons()
    {
        $icons = IconeWeb::select('nome', 'id', 'accordion')->get();

        return json_encode($icons);
    }

    public function getItensByIcon()
    {
        $icon_id = request()->get('icon_id');
        $itens = ItemWeb::where('icone_id', '=', $icon_id)->get();

        return json_encode($itens);
    }

    public function getIconsRoleChecked()
    {
        $role = request()->get('role');
        $checked = IconePerfilWeb::where('perfil_id', '=', $role)->pluck('icone_id');
        return json_encode($checked);
    }

    public function getItensRoleChecked()
    {
        $role = request()->get('role');
        $checked = ItemPerfilWeb::where('perfil_id', '=', $role)->pluck('item_id');
        return json_encode($checked);
    }

    public function store(Request $request)
    {
        $title = "Atrelar Item ao Perfil";
        $perfis = Role::orderBy('display_name')->get();

        $itens = $request->get('itens');
        $icones = $request->get('icons');
        $role_id = $request->get('role_id');

        //verifica se vieram icones do form
        if (count(IconePerfilWeb::where('perfil_id', '=', $role_id)->get()) > 0)
        {
            //se vieram icones, apaga todos os relacionados a este perfil que ja estavam no banco
            $delete = IconePerfilWeb::where('perfil_id', '=', $role_id)->delete();
            if (!$delete)
                return redirect()->back()->with(['errors' => 'Falha ao Limpar Icones']);
        }
        //verifica se vieram itens do form
        if(count(ItemPerfilWeb::where('perfil_id', '=', $role_id)->get()) > 0)
        {
            //se vieram itens, apaga todos os relacionados a este perfil que ja estavam no banco
            $delete = ItemPerfilWeb::where('perfil_id', '=', $role_id)->delete();
            if (!$delete)
                return redirect()->back()->with(['errors' => 'Falha ao Limpar Itens']);
        }
        $toAdd['perfil_id'] = $role_id;
        if (count($icones) > 0)
        {
            //adiciona os icones que vieram do form para este perfil
            foreach ($icones as $icone)
            {
                $toAdd['icone_id'] = $icone;
                $insert = IconePerfilWeb::insert($toAdd);
                if (!$insert)
                    return redirect()->back()->with(['errors' => 'Falha ao Inserir icone']);
            }
        }
        $toAdd = [];
        $toAdd['perfil_id'] = $role_id;
        if (count($itens) > 0)
        {
            //adiciona os itens que vieram do form para este perfil
            foreach ($itens as $item)
            {
                $toAdd['item_id'] = $item;
                $insert = ItemPerfilWeb::insert($toAdd);
                if (!$insert)
                    return redirect()->back()->with(['errors' => 'Falha ao Inserir item']);
            }
        }
        return view('perfilItemWeb.index', compact('title', 'perfis'));
    }
}