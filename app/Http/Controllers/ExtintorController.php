<?php

namespace App\Http\Controllers;

use App\Http\Requests\extintorFormRequest;
use App\Models\extintor;
use App\Models\extintores_veiculo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class ExtintorController extends Controller
{
    private $extintor;

    public function __construct(extintor $extintor)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->extintor = $extintor;
    }

    public function index()
    {
        $title = "Extintores";
        $extintor = $this->extintor->orderBy('id')->paginate(10);
        return view('extintor.index', compact('title', 'extintor'));
    }

    public function vincular()
    {
        $title = "Vincular Extintores aos Veículos";
        $extintor = $this->extintor->orderBy('id')->paginate(10);
        return view('extintor.vincularVeiculo', compact('title', 'extintor'));
    }

    public function create()
    {
        $title = "Cadastrar Extintor";

        return view("extintor.create", compact('title'));
    }

    public function edit($idExtintor)
    {
        $extintor = $this->extintor->find($idExtintor);

        $title = "Editar extintor : {$extintor->inscricao}";

        return view('extintor.create', compact('title', 'extintor'));
    }

    public function store(extintorFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->extintor->create($dataForm);
        if ($insert) {
            return redirect()->route('indexExtintor');
        } else {
            return redirect()->back();
        }
    }

    public function update(extintorFormRequest $request, $idExtintor)
    {
        $dataForm = $request->all();
        $extintor = $this->extintor->find($idExtintor);

        $update = $extintor->update($dataForm);

        if ($update) {
            return redirect()->route('indexExtintor');
        } else {
            return redirect()->route('editExtintor', $idExtintor)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($idExtintor){
        
        $extintor = $this->extintor->find($idExtintor);

        $inscricao = $extintor->inscricao;

        $delete = $extintor->delete();

        if ($delete) {
            return redirect()->route('indexExtintor')->with('message', 'Extintor de inscrição ' 
                .$inscricao. ' removido com sucesso.');
        } else {
            return redirect()->back()->with('errors', 'Erro ao tentar excluir.');
        }
    }
}