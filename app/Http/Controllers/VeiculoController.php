<?php

namespace App\Http\Controllers;

use App\Http\Requests\veiculoFormRequest;
use App\Models\despesa_sub_setores;
use App\Models\empresa;
use App\Models\horarioProgramado;
use App\Models\imagemVeiculos;
use App\Models\secretaria;
use App\Models\tipoVeiculo;
use App\Models\veiculo;
use App\Models\tipoCombustivel;
use App\Models\alocacaoTipoCombustivel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
{
    private $veiculo;
    private $empresa;
    private $tipoVeiculo;
    private $qtdShow = 10;
    private $secretaria;
    private $horarioProgramado;
    private $subSetor;
    private $tipoCombustivel;
    private $alocacaoTipoCombustivel;

    public function __construct(
        veiculo $veiculo,
        empresa $empresa,
        tipoVeiculo $tipoVeiculo,
        secretaria $secretaria,
        horarioProgramado $horarioProgramado,
        despesa_sub_setores $subSetor,
        tipoCombustivel $tipoCombustivel,
        alocacaoTipoCombustivel $alocacaoTipoCombustivel
    ) {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->veiculo = $veiculo;
        $this->empresa = $empresa;
        $this->tipoVeiculo = $tipoVeiculo;
        $this->secretaria = $secretaria;
        $this->horarioProgramado = $horarioProgramado;
        $this->subSetor = $subSetor;
        $this->tipoCombustivel = $tipoCombustivel;
        $this->alocacaoTipoCombustivel = $alocacaoTipoCombustivel;
    }

    public function index()
    {
        $title = 'Listagem de Veículos';
        $pesquisaPlaca = Input::get('placa');
        $pesquisaTipoVeiculo = Input::get('tipoVeiculo');
        $pesquisaModelo = Input::get('modelo');

        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $controle = \Illuminate\Support\Facades\Auth::user()->hasRole('transportador');

        if($pesquisaTipoVeiculo!=null && $pesquisaTipoVeiculo!=0){
            $contPesquisa=4;
        }else{
            $contPesquisa=0;
        }

        if($pesquisaModelo!=null && $pesquisaModelo!=""){
            $contModelo = 2;
        }else{
            $contModelo = 0;
        }

        if($pesquisaPlaca!=null && $pesquisaPlaca!=""){
            $contPlaca = 1;
        }else{
            $contPlaca = 0;
        }

        $total = $contPesquisa + $contModelo + $contPlaca;

        if($controle){
            $empresas = $this->empresa->where('id','=',$userempresa)->select()->get();
            $veiculos = $this->veiculo->where('empresa_id', '=', $userempresa);
            switch($total){
                case 1:
                    $veiculos = $veiculos->
                    where('placa','LIKE',"%$pesquisaPlaca%");
                break;
                case 2:
                    $veiculos = $veiculos->
                    where('placa','LIKE',"%$pesquisaModelo%");
                break;
                case 3:
                    $veiculos = $veiculos->
                    where('placa','LIKE',"%$pesquisaPlaca%")->
                    where('modelo','LIKE',"%$pesquisaModelo%");
                break;
                case 4:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo);
                break;
                case 5:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo)->
                    where('placa','LIKE',"%$pesquisaPlaca%");
                break;
                case 6:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo)->
                    where('modelo','LIKE',"%$pesquisaModelo%");
                break;
                case 7:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo)->
                    where('modelo','LIKE',"%$pesquisaModelo%")->
                    where('placa','LIKE',"%$pesquisaPlaca%");
                break;
            }
            $veiculos = $veiculos->join('tipo_veiculos','tipo_veiculos.id','=','veiculos.id_tipo_veiculo')->
            select('tipo_veiculos.nome', 'veiculos.*')->
            orderBy('tipo_veiculos.nome')->paginate($this->qtdShow);
        }else{
            $veiculos = $this->veiculo;
            switch($total){
                case 1:
                    $veiculos = $veiculos->where('placa','LIKE',"%$pesquisaPlaca%");
                break;
                case 2:
                    $veiculos = $veiculos->
                    where('modelo','LIKE',"%$pesquisaModelo%");
                break;
                case 3:
                    $veiculos = $veiculos->
                    where('placa','LIKE',"%$pesquisaPlaca%")->
                    where('modelo','LIKE',"%$pesquisaModelo%");
                break;
                case 4:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo);
                break;
                case 5:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo)->
                    where('placa','LIKE',"%$pesquisaPlaca%");
                break;
                case 6:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo)->
                    where('modelo','LIKE',"%$pesquisaModelo%");
                break;
                case 7:
                    $veiculos = $veiculos->
                    where('id_tipo_veiculo','=',$pesquisaTipoVeiculo)->
                    where('modelo','LIKE',"%$pesquisaModelo%")->
                    where('placa','LIKE',"%$pesquisaPlaca%");
                break;
            }
            $veiculos = $veiculos->join('tipo_veiculos','tipo_veiculos.id','=','veiculos.id_tipo_veiculo')->
            select('tipo_veiculos.nome', 'veiculos.*')->
            orderBy('tipo_veiculos.nome')->paginate($this->qtdShow);
            $empresas = $this->empresa->all();
        }

        $tipos = $this->tipoVeiculo->orderBy('nome')->get();
        $pageAtual = $veiculos->currentPage();
        $cont = ($pageAtual - 1) * $this->qtdShow;
        foreach($veiculos as $veiculo){
            $cont++;
            $veiculo->cont = $cont;
        }
        return view('veiculo.index', compact('veiculos', 'title', 'empresas', 'tipos'))->
        with('pesquisaTipoVeiculo',$pesquisaTipoVeiculo);
        
    }

    public function create()
    {
        $title = "Cadastrar Veículos";

        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $controle = true;

        if($controle){
            $empresas = $this->empresa->where('id','=',$userempresa)->select()->get();
            //dd($veiculos);
            // $secretarias = $this->secretaria->where('id', '=', $userempresa)->
            // select(['id', 'nome'])->orderBy('nome')->paginate($this->qtdShow);
            $secretarias = $this->secretaria->all();
        }else{
            $empresas = $this->empresa->all();
            $secretarias = $this->secretaria->all();
        }

        //$empresas = $this->empresa->all();
        $tipos = $this->tipoVeiculo->all();
        //$secretarias = $this->secretaria->all();
        $horariosProgramados = $this->horarioProgramado->all();
        $subSetores = $this->subSetor->all();
        $tipoCombustivel = $this->tipoCombustivel->all();

        return view("veiculo.create", compact('title', 'empresas', 'tipos', 'secretarias', 'horariosProgramados', 'subSetores', 'tipoCombustivel'));
    }

    public function edit($idVeiculo)
    {

        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $controle = \Illuminate\Support\Facades\Auth::user()->hasRole('transportador');

        if($controle){
            $empresas = $this->empresa->where('id','=',$userempresa)->select()->get();
            //dd($veiculos);
            //$secretarias = $this->secretaria->where('id', '=', $userempresa)->
            //select(['id', 'nome'])->orderBy('nome')->paginate($this->qtdShow);
            $secretarias = $this->secretaria->all();
        }else{
            $empresas = $this->empresa->all();
            $secretarias = $this->secretaria->all();
        }

        $veiculo = $this->veiculo->find($idVeiculo);
        //$empresas = $this->empresa->all();
        $tipos = $this->tipoVeiculo->all();
        //$secretarias = $this->secretaria->all();
        $horariosProgramados = $this->horarioProgramado->all();
        $tipoCombustivel = $this->tipoCombustivel->all();
        $alocacaoes = $this->alocacaoTipoCombustivel->where('veiculoId','=',$idVeiculo)->select('tipoCombustivelId')->get();
        $alocacoes = [];
        foreach ($alocacaoes as $alocacao)
            array_push($alocacoes, $alocacao->tipoCombustivelId);
        $title = "Editar Veículo: {$veiculo->placa}";

        $subSetores = $this->subSetor->all();

        return view('veiculo.create', compact('title', 'veiculo', 'empresas', 'tipos',
            'secretarias', 'horariosProgramados', 'subSetores','tipoCombustivel','alocacoes'));
    }

    public function store(veiculoFormRequest $request)
    {
        $dataForm = $request->all();
        if (isset($dataForm['imagem']))
        {
            $img = $dataForm["imagem"];

            if (($img->getClientOriginalExtension() == "png") ||
                ($img->getClientOriginalExtension() == "PNG") ||
                ($img->getClientOriginalExtension() == "jpg") ||
                ($img->getClientOriginalExtension() == "JPG"))
            {
                $extension = $img->getClientOriginalExtension();
                $pic = Image::make($img);
                Response::make($pic->encode($extension));
                $dataForm["imagem"] = $pic;
            }
        }
        if (isset($dataForm['imagem_placa']))
        {
            $img_placa = $dataForm["imagem_placa"];

            if (($img_placa->getClientOriginalExtension() == "png") ||
                ($img_placa->getClientOriginalExtension() == "PNG") ||
                ($img_placa->getClientOriginalExtension() == "jpg") ||
                ($img_placa->getClientOriginalExtension() == "JPG"))
            {
                $extension = $img_placa->getClientOriginalExtension();
                $pic_placa = Image::make($img_placa);
                Response::make($pic_placa->encode($extension));
                $dataForm["imagem_placa"] = $pic_placa;
            }
        }

        $insert = $this->veiculo->create($dataForm);
        if ($insert) {
			$tipoCombustivel = isset($dataForm["tipoCombustivel_id"]) ? $dataForm["tipoCombustivel_id"] : null;
			if ($tipoCombustivel && count($tipoCombustivel) > 0)
			{
				foreach($tipoCombustivel as $tipoId){
					$alocacaoTipoCombustivel = new alocacaoTipocombustivel();
					$alocacaoTipoCombustivel->veiculoId = $insert->id;
					$alocacaoTipoCombustivel->tipoCombustivelId = $tipoId;
					$alocacaoTipoCombustivel->save();
				}
            }
            return redirect()->route('indexVeiculo');
        } else {
            return redirect()->back()->with('errors', 'Erro ao cadastrar.');
        }
    }

    public function update(veiculoFormRequest $request, $idVeiculo)
    {
        $dataForm = $request->all();

        $veiculo = $this->veiculo->find($idVeiculo);

        if (isset($dataForm["imagem"])) {

            $img = $dataForm["imagem"];
            if (($img->getClientOriginalExtension() == "png") ||
                ($img->getClientOriginalExtension() == "PNG") ||
                ($img->getClientOriginalExtension() == "jpg") ||
                ($img->getClientOriginalExtension() == "JPG")) {
                $extension = $img->getClientOriginalExtension();
                $pic = Image::make($img);
                Response::make($pic->encode($extension));
                $dataForm["imagem"] = $pic;
                $dataForm["extensao_imagem"] = $extension;
            }
        }

        if (isset($dataForm['imagem_placa']))
        {
            $img_placa = $dataForm["imagem_placa"];

            if (($img_placa->getClientOriginalExtension() == "png") ||
                ($img_placa->getClientOriginalExtension() == "PNG") ||
                ($img_placa->getClientOriginalExtension() == "jpg") ||
                ($img_placa->getClientOriginalExtension() == "JPG"))
            {
                $extension = $img_placa->getClientOriginalExtension();
                $pic_placa = Image::make($img_placa);
                Response::make($pic_placa->encode($extension));
                $dataForm["imagem_placa"] = $pic_placa;
            }
        }

        $update = $veiculo->update($dataForm);

        if ($update) {
            $this->alocacaoTipoCombustivel->where('veiculoId','=',$veiculo->id)->delete();
            if (isset($dataForm["tipoCombustivel_id"]))
            {
                foreach ($dataForm["tipoCombustivel_id"] as $tipoId)
                {
                    $alocacaoTipoCombustivel = new alocacaoTipocombustivel();
                    $alocacaoTipoCombustivel->veiculoId = $veiculo->id;
                    $alocacaoTipoCombustivel->tipoCombustivelId = $tipoId;
                    $alocacaoTipoCombustivel->save();
                }
            }
            return redirect()->route('indexVeiculo');
        } else {
            return redirect()->back()->with('errors', 'Erro ao cadastrar.');
        }
    }

    public function delete($idVeiculo){

        //$delete = $this->veiculo->find($idVeiculo)->delete();
        
        $veiculo = $this->veiculo->find($idVeiculo);

        $placa = $veiculo->placa;

        $delete = $veiculo->delete();

        if ($delete) {
            return redirect()->route('indexVeiculo')->with('message', 'Veículo com a placa ' 
                .$placa. ' removido com sucesso.');
        } else {
            return redirect()->back()->with('errors', 'Erro ao tentar excluir.');
        }
    }

    public function details($idVeiculo){
        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $controle = \Illuminate\Support\Facades\Auth::user()->hasRole('transportador');
        $veiculo = $this->veiculo->find($idVeiculo);
        $empresa = $this->empresa->find($veiculo->empresa_id);
        $secretaria = $this->secretaria->find($veiculo->secretaria_id);
        $tipoVeiculo = $this->tipoVeiculo->find($veiculo->id_tipo_veiculo);
        $horarioProgramado = $this->horarioProgramado->find($veiculo->horario_programado_id);
        $title = "Visualizar Veículo: {$veiculo->placa}";
        return view('veiculo.details', compact('title', 'veiculo', 'empresa', 'tipoVeiculo',
            'secretaria', 'horarioProgramado'));
    }

    public function checkBarcode()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT 1
                        FROM veiculos 
                        WHERE codigo_barra = ?
                        AND id <> ?"
                ),
                array(
                    request()->get('barcode'),
                    request()->get('veiculo_id')
                )
            )
        );
    }
}
