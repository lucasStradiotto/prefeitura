<?php

namespace App\Http\Controllers;

use App\Models\IconItemCidadeFacil;
use App\Models\iconesCidadeFacil;
use App\Models\ItemCidadeFacil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class IconItemCidadeFacilController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Atrelar Item ao ícone";
        $icones = iconesCidadeFacil::orderBy('display_name')->get();

        return view('itemIconeCidadeFacil.index', compact('title', 'icones'));
    }

    public function getItensIconChecked()
    {
        $icon = request()->get('icon');
        $checked = IconItemCidadeFacil::where('icon_id', '=', $icon)
            ->select('item_id')
            ->get();
        $itensChecked=[];
        foreach($checked as $check)
            array_push($itensChecked, $check->item_id);

        return json_encode($itensChecked);
    }

    public function store(Request $request)
    {
        $title = "Atrelar Item ao ícone";
        $icones = iconesCidadeFacil::orderBy('display_name')->get();

        $itens = $request->get('itens');
        $id_icone = $request->get('icon_id');

        if(count(IconItemCidadeFacil::where('icon_id', '=', $id_icone)->get()) > 0)
        {
            $delete = IconItemCidadeFacil::where('icon_id', '=', $id_icone)->delete();
            if (!$delete)
                return redirect()->back()->with(['errors' => 'Falha ao Limpar']);
        }
        $toAdd['icon_id'] = $id_icone;
        if (count($itens))
        {
            foreach($itens as $item)
            {
                $toAdd['item_id'] = $item;
                $insert = IconItemCidadeFacil::insert($toAdd);
                if (!$insert)
                    return redirect()->back()->with(['errors' => 'Falha ao Inserir']);
            }
        }
        return view('itemIconeCidadeFacil.index', compact('title', 'icones'));
    }
}