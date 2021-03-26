<?php

namespace App\Http\Controllers;

use App\Models\ServicoRedeEletrica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ServicoRedeEletricaController extends Controller
{
    private $servicosEletrica;

    public function __construct(ServicoRedeEletrica $servicosEletrica)
    {
        $this->servicosEletrica = $servicosEletrica;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }


    public function index()
    {
        $title = "Serviço de Rede Elétrica";
        $servicosEletrica = $this->servicosEletrica->paginate(10);
        return view('parametrosFiscalizacao.servicoRedeEletrica.index', compact('title', 'servicosEletrica'));
    }

    public function create()
    {
        $title = "Criar Novo Serviço de Rede Elétrica";
        return view('parametrosFiscalizacao.servicoRedeEletrica.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_rede_eletrica');

        $insert = $this->servicosEletrica->create($form);

        if ($insert) {
            return redirect()->route('servicoRedeEletrica.index');
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function edit($tipo_rede_eletrica, $id)
    {
        $title = "Editar Serviço de Rede Elétrica";
        return view('parametrosFiscalizacao.servicoRedeEletrica.edit', compact('title', 'tipo_rede_eletrica', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('servico_rede_eletrica')
            ->where('id', $request->get('id'))
            ->update(['tipo_rede_eletrica' => $request->get('tipo_rede_eletrica')]);

        if ($update) {
            return redirect()->route('servicoRedeEletrica.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('servico_rede_eletrica')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('servicoRedeEletrica.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
