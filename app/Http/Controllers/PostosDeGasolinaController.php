<?php

namespace App\Http\Controllers;

use App\Http\Requests\postosDeGasolinaFormRequest;
use App\Models\postosDeGasolina;
use App\Models\tipoCombustivel;
use App\Models\fornecedorTipoCombustivel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PostosDeGasolinaController extends Controller
{
    private $qtdShow = 10;
    private $postosDeGasolina;
    private $tipoCombustivel;

    public function __construct(postosDeGasolina $postoDeGasolina, tipoCombustivel $tipoCombustivel, 
    fornecedorTipoCombustivel $fornecedorTipoCombustivel)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->postosDeGasolina = $postoDeGasolina;
        $this->tipoCombustivel = $tipoCombustivel;
        $this->fornecedorTipoCombustivel = $fornecedorTipoCombustivel;
    }

    public function index()
    {
        $title = 'Listagem de Postos';
        $postos = $this->postosDeGasolina->orderBy('nome')->get();

        return view('postosDeGasolina.index', compact( 'title', 'postos'));
    }

    public function create()
    {
        $title = 'Cadastro de Posto';
        $tiposCombustivel = $this->tipoCombustivel->orderBy('descricao')->get();

        return view('postosDeGasolina.create', compact( 'title', 'tiposCombustivel'));
    }

    public function store(postosDeGasolinaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->postosDeGasolina->create($dataForm);
        if ($insert) {
            $tiposCombustivel = $request->get('tipo_combustivel');
            foreach ($tiposCombustivel as $key => $tipo) {
                fornecedorTipoCombustivel::create(
                    [
                        'posto_id' => $insert->id,
                        'tipo_combustivel_id' => $tipo
                    ]
                );
            }
            return redirect()->route('indexPosto');
        } else {
            return redirect()->back();
        }
    }

    public function edit($idPosto)
    {
        $posto = $this->postosDeGasolina->find($idPosto);

        $title = "Editar Posto: {$posto->nome}";

        $tiposCombustivel = $this->tipoCombustivel
        ->leftJoin('fornecedor_tipo_combustivels', function ($join) use ($idPosto)
        {
            $join->on('tipo_combustivels.id', '=', 'fornecedor_tipo_combustivels.tipo_combustivel_id');
            $join->on('posto_id', '=', DB::raw($idPosto));
        })->select('tipo_combustivels.id', 'tipo_combustivels.descricao', 'fornecedor_tipo_combustivels.tipo_combustivel_id')->get();

        return view('postosDeGasolina.create', compact('title', 'posto', 'tiposCombustivel'));
    }

    public function update(postosDeGasolinaFormRequest $request , $idPosto)
    {
        $dataForm = $request->all();
        $posto = $this->postosDeGasolina->find($idPosto);

        $update = $posto->update($dataForm);

        if ($update) {
            fornecedorTipoCombustivel::where('posto_id', '=', DB::raw($idPosto))->delete();
            $tiposCombustivel = $request->get('tipo_combustivel');
            foreach ($tiposCombustivel as $key => $tipo) {
                fornecedorTipoCombustivel::create(
                    [
                        'posto_id' => $idPosto,
                        'tipo_combustivel_id' => $tipo
                    ]
                );
            }
            return redirect()->route('indexPosto');
        } else {
            return redirect()->route('editPosto', $idPosto)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function hash(\Illuminate\Http\Request $request){
        $post = $request->get("pass");

        return json_encode(array("senha" => Hash::make($post)));
    }

    public function details($idPosto){
        $posto = $this->postosDeGasolina->find($idPosto);
        $fornecedorTipoCombustivel = $this->fornecedorTipoCombustivel->where('posto_id',$posto->id)
        ->select('tipo_combustivel_id')
        ->get();
        $tipoCombustivel = $this->tipoCombustivel->whereIn('id',$fornecedorTipoCombustivel)->get();
        $title = "Visualizar Posto de Combustível: {$posto->nome}";
        return view('postosDeGasolina.details',compact('title','posto','tipoCombustivel'));
    }

    public function delete($idPosto){
        $posto = $this->postosDeGasolina->find($idPosto);
        $nome = $posto->nome_fantasia;
        $delete = $posto->delete();
        if($delete){
            return redirect()->route('indexPosto')->with('message','Posto de combustível '.$nome.' removido com sucesso.');
        }else{
            return redirect()->back()->with('errors','Erro ao tentar excluir.');
        }
    }


}
