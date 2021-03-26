<?php

namespace App\Http\Controllers;

use App\Models\NumeroPavimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class NumeroPavimentoController extends Controller
{
    private $numeroPavimento;

    public function __construct(NumeroPavimento $numeroPavimento)
    {
        $this->numeroPavimento = $numeroPavimento;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }


    public function index()
    {
        $title = "Número Dos Pavimentos";
        $numeroPavimento = $this->numeroPavimento->paginate(10);
        return view('parametrosFiscalizacao.numeroPavimento.index', compact('title', 'numeroPavimento'));
    }

    public function create()
    {
        $title = "Criar Novo Pavimento";
        return view('parametrosFiscalizacao.numeroPavimento.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_pavimento');

        $insert = $this->numeroPavimento->create($form);

        if ($insert) {
            return redirect()->route('numeroPavimento.index');
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function edit($tipo_pavimento, $id)
    {
        $title = "Editar Número do Pavimento";
        return view('parametrosFiscalizacao.numeroPavimento.edit', compact('title', 'tipo_pavimento', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('numero_pavimento')
            ->where('id', $request->get('id'))
            ->update(['tipo_pavimento' => $request->get('tipo_pavimento')]);

        if ($update) {
            return redirect()->route('numeroPavimento.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('numero_pavimento')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('numeroPavimento.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
