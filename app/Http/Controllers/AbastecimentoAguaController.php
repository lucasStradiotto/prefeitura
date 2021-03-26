<?php

namespace App\Http\Controllers;

use App\Models\AbastecimentoAgua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AbastecimentoAguaController extends Controller
{
    private $abastecimento;

    public function __construct(AbastecimentoAgua $abastecimento)
    {
        $this->abastecimento = $abastecimento;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }


    public function index()
    {
        $title = "Abastecimento de Água";
        $abastecimento = $this->abastecimento->paginate(10);
        return view('parametrosFiscalizacao.abastecimentoAgua.index', compact('title', 'abastecimento'));
    }

    public function create()
    {
        $title = "Criar Novo Abastecimento de Água";
        return view('parametrosFiscalizacao.abastecimentoAgua.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_abastecimento');

        $insert = $this->abastecimento->create($form);

        if ($insert) {
            return redirect()->route('abastecimentoAgua.index');
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function edit($tipo_abastecimento, $id)
    {
        $title = "Editar Abastecimento de Água";
        return view('parametrosFiscalizacao.abastecimentoAgua.edit', compact('title', 'tipo_abastecimento', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('abastecimento_agua')
            ->where('id', $request->get('id'))
            ->update(['tipo_abastecimento' => $request->get('tipo_abastecimento')]);

        if ($update) {
            return redirect()->route('abastecimentoAgua.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('abastecimento_agua')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('abastecimentoAgua.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
