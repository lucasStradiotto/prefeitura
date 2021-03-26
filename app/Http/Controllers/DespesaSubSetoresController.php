<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\despesa_setores;
use App\Models\despesa_sub_setores;
use App\Models\secretaria;
use App\Http\Requests\despesa_sub_setoresFormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class DespesaSubSetoresController extends Controller
{
    private $despesa_setores;
    private $despesa_sub_setores;
    private $qtdShow = 10;

    public function __construct(despesa_setores $despesa_setores, despesa_sub_setores $despesa_sub_setores)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');

        $this->despesa_setores = $despesa_setores;
        $this->despesa_sub_setores = $despesa_sub_setores;
    }

    public function index()
    {
        $title = 'Listagem de Sub Setores';

        $subSetores = $this->despesa_sub_setores
        ->join('despesa_setores', 'despesa_setores.id', '=', 'despesa_sub_setores.despesa_setor_id')
        ->leftJoin('secretarias', 'secretarias.id', '=', 'despesa_setores.secretaria_id')
        ->select('despesa_sub_setores.id', 'despesa_sub_setores.nome', DB::raw('despesa_setores.nome as setor'), 'secretarias.nome as secretaria')
        ->orderBy('nome')->paginate($this->qtdShow);

        return view('despesa_sub_setores.index', compact('title', 'subSetores'));
    }

    public function create()
    {
        $title = 'Cadastrar Sub Setor';

        $setores = $this->despesa_setores->orderBy('nome')->get();

        return view('despesa_sub_setores.create', compact('title', 'setores'));
    }

    public function edit($idSubSetor)
    {
        $setores = $this->despesa_setores->orderBy('nome')->get();

        $subSetor = $this->despesa_sub_setores->find($idSubSetor);

        $title = "Editar Sub Setor: {$subSetor->nome}";

        return view('despesa_sub_setores.create', compact('title', 'setores', 'subSetor'));
    }

    public function store(despesa_sub_setoresFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->despesa_sub_setores->create($dataForm);

        if ($insert) {
            return redirect()->route('indexDespesaSubSetores');
        } else {
            return redirect()->back();
        }
    }

    public function update(despesa_sub_setoresFormRequest $request, $idSubSetor)
    {
        $dataForm = $request->all();

        $subSetor = $this->despesa_sub_setores->find($idSubSetor);

        $update = $subSetor->update($dataForm);

        if ($update) {
            return redirect()->route('indexDespesaSubSetores');
        } else {
            return redirect()->route('editDespesaSubSetores', $idSubSetor)->with(['errors' => 'Falha ao editar']);
        }        
    }

    public function getSubSetores()
    {
        $ids = request()->get('setores') ?
               request()->get('setores') :
               [];
        $setores = [];

        foreach ($ids as $id)
        {
            $temparray = $this->despesa_sub_setores->where('despesa_setor_id', $id)->get();
            foreach ($temparray as $set)
                array_push($setores, $set);
        }
        return json_encode($setores);
//        return $this->despesa_sub_setores->orderBy('nome')->get();
    }

    public function delete($idSubSetor){
        $subSetor = $this->despesa_sub_setores->find($idSubSetor);
        $nome = $subSetor->nome;
        $delete = $subSetor->delete();
        if($delete){
            return redirect()->route('indexDespesaSubSetores')->with('message','O sub setor '.$nome.' foi removido com sucesso.');
        }else{
            return redirect()->back()->with('errors','Erro ao tentar excluir.');
        }
    }

    public function details($idSubSetor){
        $subSetor = $this->despesa_sub_setores->find($idSubSetor);
        $setor = $this->despesa_setores->find($subSetor->despesa_setor_id);
        $title = "Visualizar Sub Setor: {$subSetor->nome}";
        return view('despesa_sub_setores.details', compact('subSetor','setor','title'));
    }
}
