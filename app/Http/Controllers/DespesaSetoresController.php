<?php

namespace App\Http\Controllers;

use App\Http\Requests\despesa_setoresFormRequest;
use App\Models\despesa_setores;
use App\Models\secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class DespesaSetoresController extends Controller
{
    private $despesa_setores;
    private $secretaria;
    private $qtdShow = 10;

    public function __construct(despesa_setores $despesa_setores, secretaria $secretaria)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');

        $this->despesa_setores = $despesa_setores;
        $this->secretaria = $secretaria;
    }

    public function index()
    {
        $title = 'Listagem de Setores';

        $setores = $this->despesa_setores->leftJoin('secretarias', 'secretarias.id', '=', 'despesa_setores.secretaria_id')
            ->orderBy('despesa_setores.nome')->select('despesa_setores.*', 'secretarias.nome as secretaria')->paginate($this->qtdShow);

        return view('despesa_setores.index', compact('title', 'setores'));
    }

    public function create()
    {
        $title = 'Cadastrar Setor';

        $secretarias = $this->secretaria->all();

        return view('despesa_setores.create', compact('title', 'secretarias'));
    }

    public function edit($idSetor)
    {
        $setor = $this->despesa_setores->find($idSetor);

        $title = "Editar Setor: {$setor->nome}";

        $secretarias = $this->secretaria->all();

        return view('despesa_setores.create', compact('title', 'setor', 'secretarias'));
    }

    public function store(despesa_setoresFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->despesa_setores->create($dataForm);

        if ($insert) {
            return redirect()->route('indexDespesaSetores');
        } else {
            return redirect()->back();
        }
    }

    public function update(despesa_setoresFormRequest $request, $idSetor)
    {
        $dataForm = $request->all();

        $setor = $this->despesa_setores->find($idSetor);

        $update = $setor->update($dataForm);

        if ($update) {
            return redirect()->route('indexDespesaSetores');
        } else {
            return redirect()->route('editDespesaSetores', $idSetor)->with(['errors' => 'Falha ao editar']);
        }        
    }

    public function delete($idDepesaSetor){
        $despesaSetor = $this->despesa_setores->find($idDepesaSetor);
        $setor = $despesaSetor->nome;
        $delete = $despesaSetor->delete();
        if($delete){
            return redirect()->route('indexDespesaSetores')->with('message','O setor '.$setor.' foi removido com sucesso.');
        }else{
            return redirect()->back()->with('errors','Erro ao tentar excluir');
        }
    }
    
    public function getSetores()
    {
        $ids = request()->get('secretarias') ?
               request()->get('secretarias') :
               [];
        $secretarias = [];

        foreach ($ids as $id)
        {
            $temparray = $this->despesa_setores->where('secretaria_id', $id)->get();
            foreach ($temparray as $sec)
                array_push($secretarias, $sec);
        }
        return json_encode($secretarias);
    }
}
