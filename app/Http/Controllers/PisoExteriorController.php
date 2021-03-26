<?php

namespace App\Http\Controllers;

use App\Models\PisoExterior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PisoExteriorController extends Controller
{
    private $pisos;

    public function __construct(PisoExterior $pisos)
    {
        $this->pisos = $pisos;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }


    public function index()
    {
        $title = "Pisos Externos";
        $pisos = $this->pisos->paginate(10);
        return view('parametrosFiscalizacao.pisoExterno.index', compact('title', 'pisos'));
    }

    public function create()
    {
        $title = "Criar Novo Piso Externo";
        return view('parametrosFiscalizacao.pisoExterno.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_piso');

        $insert = $this->pisos->create($form);

        if ($insert) {
            return redirect()->route('pisoExterno.index');
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function edit($tipo_piso, $id)
    {
        $title = "Editar Piso Externo";
        return view('parametrosFiscalizacao.pisoExterno.edit', compact('title', 'tipo_piso', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('piso_ext')
            ->where('id', $request->get('id'))
            ->update(['tipo_piso' => $request->get('tipo_piso')]);

        if ($update) {
            return redirect()->route('pisoExterno.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('piso_ext')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('pisoExterno.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
