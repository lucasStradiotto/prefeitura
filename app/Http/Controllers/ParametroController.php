<?php

namespace App\Http\Controllers;

use App\Models\parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ParametroController extends Controller
{
    private $parametro;

    public function __construct(parametro $parametro)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->parametro = $parametro;
    }

    public function index()
    {
        $title = 'Prazo para Caçamba';
        $prazo = $this->parametro->where('tipo', '=', 1)->first();

        return view('prazo.index', compact('title', 'prazo'));
    }

    public function create()
    {
        $title = 'Atribuir Prazo para Caçamba';
        $prazo = $this->parametro->where('tipo', '=', 1)->first();

        return view('prazo.create', compact('title', 'prazo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'prazo' => 'required'
        ], [
            'prazo.required' => 'Insira o prazo da caçamba!'
        ]);

        $dataForm = $request->all();
        $insert = $this->parametro->create($dataForm);
        if ($insert) {
            return redirect()->route('indexPrazo');
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $prazo = $this->parametro->where('tipo', '=', 1)->first();
        if ($prazo == null) {
            if ($this->store($request)) {
                return redirect()->route('indexPrazo');
            } else {
                return redirect()->back();
            }
        } else {
            $this->validate($request, [
                'prazo' => 'required'
            ], [
                'prazo.required' => 'Insira o prazo da caçamba!'
            ]);

            $dataForm = $request->all();
            $prazo = $this->parametro->where('tipo', "=", 1)->first();

            $update = $prazo->update($dataForm);
            if ($update) {
                return redirect()->route('indexPrazo');
            } else {
                return redirect()->route('createPrazo')->with(['errors' => 'Falha ao editar']);
            }
        }
    }
}
