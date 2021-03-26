<?php

namespace App\Http\Controllers;

use App\Models\iconesCidadeFacil;
use App\Models\ItemCidadeFacil;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Image;

class ControleAcessoController extends Controller
{

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Controle de Acesso";

        return view('controleAcesso', compact('title'));
    }

    public function getItens()
    {
        $itens = ItemCidadeFacil::orderBy('display_name')->get();

        return json_encode($itens);
    }

    public function getIconImage()
    {
        $id = request()->get('id');
        if ($id != '0') {
            $imagem = Image::make(iconesCidadeFacil::find($id)->icone);
            $response = \Response::make($imagem->encode('data-url'));

            return $response;
        }
        else
            return "";
    }
}
