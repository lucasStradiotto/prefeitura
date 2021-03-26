<?php

namespace App\Http\Controllers;

use App\Models\ServicoEsgoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ServicoEsgotoController extends Controller
{
    private $servicoEsgoto;

    public function __construct(ServicoEsgoto $servicoEsgoto)
    {
        $this->servicoEsgoto = $servicoEsgoto;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Serviço de Esgoto";
        $servicosEsgoto = $this->servicoEsgoto->paginate(10);
        return view('parametrosFiscalizacao.servicoEsgoto.index', compact('title', 'servicosEsgoto'));
    }

    public function create()
    {
        $title = "Criar Novo Serviço de Esgoto";
        return view('parametrosFiscalizacao.servicoEsgoto.create', compact('title'));
    }

    public function store(Request $request)
    {
        $form = $request->only('tipo_esgoto');

        $insert = $this->servicoEsgoto->create($form);

        if ($insert) {
            return redirect()->route('servicoEsgoto.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function edit($tipo_esgoto, $id)
    {
        $title = "Editar Serviço de Esgoto";
        return view('parametrosFiscalizacao.servicoEsgoto.edit', compact('title', 'tipo_esgoto', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('servico_esgoto')
            ->where('id', $request->get('id'))
            ->update(['tipo_esgoto' => $request->get('tipo_esgoto')]);

        if ($update) {
            return redirect()->route('servicoEsgoto.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('servico_esgoto')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('servicoEsgoto.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
