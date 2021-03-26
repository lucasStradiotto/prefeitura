<?php

namespace App\Http\Controllers;

use App\Models\iconesCidadeFacil;
use App\Models\IconItemCidadeFacil;
use App\Models\ItemCidadeFacil;
use App\Models\PerfilItemCidadeFacil;
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class PerfilItemCidadeFacilController extends Controller
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

        return view('perfilItemCidadeFacil.index', compact('title', 'perfis'));
    }

    public function getIcons()
    {
        $icons = iconesCidadeFacil::select('display_name', 'id')->get();

        return json_encode($icons);
    }

    public function getItensByIcon()
    {
        $icon_id = request()->get('icon_id');
        $itens = IconItemCidadeFacil::join('itens_cidade_facil', 'icon_item_cidade_facil.item_id', '=', 'itens_cidade_facil.id')
            ->where('icon_id', '=', $icon_id)
            ->select('itens_cidade_facil.display_name', 'itens_cidade_facil.id')
            ->get();

        return json_encode($itens);
    }

    public function getItensRoleChecked()
    {
        $role = request()->get('role');
        $checked = PerfilItemCidadeFacil::where('role_id', '=', $role)
            ->select('item_id')
            ->get();
        $itensChecked=[];
        foreach($checked as $check)
            array_push($itensChecked, $check->item_id);

        return json_encode($itensChecked);
    }

    public function store(Request $request)
    {
        $title = "Atrelar Item ao Perfil";
        $perfis = Role::orderBy('display_name')->get();

        $itens = $request->get('itens');
        $role_id = $request->get('role_id');

        if(count(PerfilItemCidadeFacil::where('role_id', '=', $role_id)->get()) > 0)
        {
            $delete = PerfilItemCidadeFacil::where('role_id', '=', $role_id)->delete();
            if (!$delete)
                return redirect()->back()->with(['errors' => 'Falha ao Limpar']);
        }
        $toAdd['role_id'] = $role_id;
        if (count($itens))
        {
            foreach ($itens as $item)
            {
                $toAdd['item_id'] = $item;
                $insert = PerfilItemCidadeFacil::insert($toAdd);
                if (!$insert)
                    return redirect()->back()->with(['errors' => 'Falha ao Inserir']);
            }
        }
        return view('perfilItemCidadeFacil.index', compact('title', 'perfis'));
    }
}