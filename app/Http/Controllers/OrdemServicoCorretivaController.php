<?php

namespace App\Http\Controllers;

use App\Http\Requests\ordemServicoCorretivaFormRequest;
use App\Models\ordemServicoCorretiva;
use App\Models\pecasCorretivas;
use App\Models\secretaria;
use App\Models\veiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Image;

class OrdemServicoCorretivaController extends Controller
{
    private $corretiva;
    private $veiculo;
    private $secretaria;

    public function __construct(ordemServicoCorretiva $corretiva, veiculo $veiculo, secretaria $secretaria)
    {
        $this->middleware('auth');
        Session::put('url.intended', URL::current());
        $this->corretiva = $corretiva;
        $this->veiculo = $veiculo;
        $this->secretaria = $secretaria;
    }

    public function index()
    {
        $title = 'Manutenção Corretiva';
        $userempresa = Auth::user()->empresa_id;
        if (Auth::user()->hasRole('transportador')) {
            $veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();
            $corretivas = ordemServicoCorretiva::join('veiculos','veiculos.id','=','ordem_servico_corretivas.veiculo_id')
                ->join('empresas','empresas.id','=',"veiculos.empresa_id")
                ->select('ordem_servico_corretivas.*')
                ->where('veiculos.empresa_id','=',$userempresa)->get();
        } else {
            $veiculos = $this->veiculo->all();
            $corretivas = $this->corretiva->all();
        }
        $secretarias = $this->secretaria->all();

        return view('corretiva.index', compact('title', 'veiculos', 'corretivas', 'secretarias'));
    }

    public function create()
    {
        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $title = 'Gerar Ordem de Serviço';

        if (Auth::user()->hasRole('transportador')) {
            $veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();
        } else {
            $veiculos = $this->veiculo->all();
        }

        return view('corretiva.create', compact('title', 'veiculos'));
    }

    public function edit($id)
    {

        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $title = 'Fechar Ordem de Serviço';
        if (Auth::user()->hasRole('transportador')) {
            $veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();
        } else {
            $veiculos = $this->veiculo->all();
        }
        $corretiva = $this->corretiva->find($id);
        return view('corretiva.create', compact('title', 'veiculos', 'corretiva'));
    }

    public function store(ordemServicoCorretivaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->corretiva->create($dataForm);

        if ($insert)
        {
            return redirect()->route('indexCorretiva');
        }
        else
        {
            return redirect()->back()->withErrors();
        }
    }

    public function update(ordemServicoCorretivaFormRequest $request, $id)
    {
        
        $dataForm = $request->all();
        
        $corretiva = $this->corretiva->find($id);

        $nomes = $dataForm["nomes"];
        $qtds = $dataForm["qtds"];
        $valores = $dataForm["valores"];
        $codigos = $dataForm["codigos"];

        $data = explode('-', $dataForm["data_execucao"]);
            $dia = $data[0];
            $mes = $data[1];
            $ano = $data[2];

        $n_orcamento = request()->file('numero_orcamento_doc');
        $docsPath1 = "docs/pdfs/numero_orcamento_doc";

        $fileName1 = 
            $dia .  
            $mes .  
            $ano . $n_orcamento->getClientOriginalName();

        $destinationPath1 = public_path($docsPath1);
        $n_orcamento->move($destinationPath1, $fileName1);



        $n_empenho = request()->file('numero_empenho_doc');
        $docsPath2 = "docs/pdfs/numero_empenho_doc";

        $fileName2 = 
            $dia . 
            $mes . 
            $ano . $n_empenho->getClientOriginalName();

        $destinationPath2 = public_path($docsPath2);
        $n_empenho->move($destinationPath2, $fileName2);



        $n_autorizacao = request()->file('numero_autorizacao_doc');
        $docsPath3 = "docs/pdfs/numero_autorizacao_doc";

        $fileName3 = 
            $dia .  
            $mes .  
            $ano . $n_autorizacao->getClientOriginalName();
        
        $destinationPath3 = public_path($docsPath3);
        $n_autorizacao->move($destinationPath3, $fileName3);

        

        $n_nf = request()->file('nf_doc');
        $docsPath4 = "docs/pdfs/nf_doc";

        $fileName4 = 
            $dia .  
            $mes . 
            $ano . $n_nf->getClientOriginalName();

        $destinationPath4 = public_path($docsPath4);
        $n_nf->move($destinationPath4, $fileName4);

        $dataForm['numero_orcamento_doc']=$fileName1;
        $dataForm['numero_empenho_doc']=$fileName2;
        $dataForm['numero_autorizacao_doc']=$fileName3;
        $dataForm['nf_doc']=$fileName4;

        $update = $corretiva->update($dataForm);

        if ($update)
        {
            for ($i=0; $i<count($nomes); $i++)
            {
                $pecas = new pecasCorretivas();
                $pecas->codigo = $codigos[$i];
                $pecas->nome = $nomes[$i];
                $pecas->qtd = $qtds[$i];
                $pecas->valor = $valores[$i];
                $pecas->ordem_servico_id = $id;
                $pecas->save();
            }

            return redirect()->route('indexCorretiva');
        }
        else
        {
            return redirect()->back()->withErrors();
        }
    }

    public function downloadAllImagemVeiculo(Request $request)
    {
        $imgs = array();
        $send = 0;
        $response = [];
        $id = $request->all()["veiculo_id"];
        $imagem_veiculo = Veiculo::find($id)->imagem;
        $imagem_placa = Veiculo::find($id)->imagem_placa;

        if (isset($imagem_veiculo)) {
            $imagem = Image::make($imagem_veiculo);
            $response_img = \Response::make($imagem->encode('data-url'));
            $send ++;
        }

        if (isset($imagem_placa)) {
            $imagem = Image::make($imagem_placa);
            $response_img_placa = \Response::make($imagem->encode('data-url'));
            $send++;
        }

        if($send != 0){
            return compact('response_img','response_img_placa');
        };

        return "";
    }
}
