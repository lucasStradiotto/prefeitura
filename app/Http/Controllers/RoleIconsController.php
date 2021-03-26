<?php

namespace App\Http\Controllers;

use App\Models\iconesCidadeFacil;
use App\Role;
use App\Models\role_icons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RoleIconsController extends Controller
{
    private $perfil;
    private $icone;
    private $role_icon;

    public function __construct(Role $perfil, iconesCidadeFacil $icone, role_icons $role_icons)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->perfil = $perfil;
        $this->icone = $icone;
        $this->role_icon = $role_icons;
    }

    public function index()
    {
        $title = 'Atrelar Perfis aos Icones';
        $perfis = $this->perfil->orderBy('display_name')->get();
        $perfilSelecionado = 0;

        return view('roleIcons.index', compact('perfis', 'perfilSelecionado', 'title'));
    }

    public function getIconsRoleChecked()
    {
        $role_id = request()->get('role_id');
        $checked = role_icons::where('role_id', '=', $role_id)->select('icon_id')->get();

        $itensChecked=[];
        foreach($checked as $check)
            array_push($itensChecked, $check->icon_id);

        return json_encode($itensChecked);
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $role_id = $dataForm["role_id"];

        $toDelete = $this->role_icon->where('role_id', '=', $role_id)->get();
        foreach ($toDelete as $item)
        {
            $delete = $item->delete();
            if (!$delete)
                return redirect()->back()->with(['errors' => 'Falha ao Limpar Registros']);
        }

        $toAdd["role_id"] = $role_id;
        foreach($dataForm["icons"] as $icone)
        {
            $toAdd["icon_id"] = $icone;
            $insert = $this->role_icon->insert($toAdd);
            if (!$insert)
                return redirect()->back()->with(['errors' => 'Falha ao Inserir']);
        }

        return redirect()->route('indexRoleIcons');
    }
}