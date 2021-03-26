<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoligonoFormRequest;
use App\Models\cercasEletronica;
use App\Models\poligono;
use App\Models\tipoPoligono;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PoligonoController extends Controller
{
    private $poligono;
    private $tipoPoligono;
    private $qtdShow = 10;

    public function __construct(poligono $poligono, tipoPoligono $tipoPoligono)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->poligono = $poligono;
        $this->tipoPoligono = $tipoPoligono;
    }

    public function index()
    {
        $title = 'Listagem de Poligonos';
        $poligonos = $this->poligono->orderBy('tipo_poligono_id')
            ->orderBy('nome')
            ->paginate($this->qtdShow);
        $tipos = $this->tipoPoligono->all();

        return view('poligono.index', compact('poligonos', 'title', 'tipos'));
    }

    public function create()
    {
        $title = "Cadastrar Poligono";
        $tipos = $this->tipoPoligono->all();

        return view("poligono.create", compact('title', 'tipos'));
    }

    public function edit($idPoligono)
    {
        $poligono = $this->poligono->find($idPoligono);
        $tipos = $this->tipoPoligono->all();

        $title = "Editar Poligono: {$poligono->nome}";

        return view('poligono.create', compact('title', 'poligono', 'tipos'));
    }

    public function store(PoligonoFormRequest $request)
    {
        $dataForm = $request->all();
        if (isset($dataForm["cerca_gera_notificacao"])) {
            $dataForm["cerca_gera_notificacao"] = 1;
        } else {
            $dataForm["cerca_gera_notificacao"] = 0;
        }

        if (isset($dataForm["cerca_area_risco"])) {
            $dataForm["cerca_area_risco"] = 1;
        } else {
            $dataForm["cerca_area_risco"] = 0;
        }

        $insert = $this->poligono->create($dataForm);
        if ($insert) {
            return redirect()->route('indexPoligono');
        } else {
            return redirect()->back();
        }
    }

    public function update(PoligonoFormRequest $request, $idPoligono)
    {
        $dataForm = $request->all();
        if (isset($dataForm["cerca_gera_notificacao"])) {
            $dataForm["cerca_gera_notificacao"] = 1;
        } else {
            $dataForm["cerca_gera_notificacao"] = 0;
        }

        if (isset($dataForm["cerca_area_risco"])) {
            $dataForm["cerca_area_risco"] = 1;
        } else {
            $dataForm["cerca_area_risco"] = 0;
        }

        $poligono = $this->poligono->find($idPoligono);
        $update = $poligono->update($dataForm);

        if ($update) {
            return redirect()->route('indexPoligono');
        } else {
            return redirect()->route('editPoligono', $idPoligono)->with(['errors' => 'Falha ao editar']);
        }
    }
}
