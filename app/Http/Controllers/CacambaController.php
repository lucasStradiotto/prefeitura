<?php

namespace App\Http\Controllers;

use App\Http\Requests\cacambaFormRequest;
use App\Models\cacamba;
use App\Models\empresa;
use App\Models\StatusCacamba;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CacambaController extends Controller
{
    private $cacamba;
    private $empresa;
    private $perPage = 15;

    public function __construct(cacamba $cacamba, empresa $empresa)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->cacamba = $cacamba;
        $this->empresa = $empresa;
    }

    public function index()
    {
        $title = 'Listagem de Caçambas';
        $filter = request()->get('filter');
        $cacambas = $this->cacamba->join('empresas', 'empresas.id', '=', 'cacambas.empresa_id');
        if ($filter) {
            $cacambas = $cacambas->where('empresas.razao_social', 'LIKE', "%$filter%")
                ->orWhere('empresas.nome_fantasia', 'LIKE', "%$filter%");
        }
        $cacambas = $cacambas
            ->leftJoin('ordem_coletas', function ($join) {
                $join->on('ordem_coletas.codigo_cacamba', '=', 'cacambas.codigo');
                $join->on('ordem_coletas.empresa_id', '=', 'cacambas.empresa_id');
            })
            ->leftJoin('bairros', 'ordem_coletas.bairro_obra_id', '=', 'bairros.id')
            ->leftJoin('ruas', 'ordem_coletas.endereco_obra_id', '=', 'ruas.id')
            ->whereNull('ordem_coletas.data_retirada');

        $cacambas = $cacambas->select('cacambas.*', 'bairros.nome as nome_bairro',
            'ruas.nome as nome_rua', 'ordem_coletas.numero_obra as numero_casa', 'ordem_coletas.data_entrega')
            ->orderByRaw('cacambas.empresa_id, CAST(cacambas.codigo AS UNSIGNED)')->paginate($this->perPage);

        $status = StatusCacamba::all();

        return view('cacamba.index', compact('cacambas', 'title', 'status'));
    }

    public function create()
    {
        $title = "Cadastrar Caçamba";

        $empresas = $this->empresa->all();
        $status = StatusCacamba::all();

        return view("cacamba.create", compact('title', 'empresas', 'status'));
    }

    public function edit($idCacamba)
    {
        $cacamba = $this->cacamba->find($idCacamba);
        $empresas = $this->empresa->all();
        $status = StatusCacamba::all();

        $title = "Editar Caçambas: {$cacamba->codigo}";

        return view('cacamba.create', compact('title', 'cacamba', 'empresas', 'status'));
    }

    public function store(cacambaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = null;
        if ($dataForm['qtd']) {
            $empresa_id = $dataForm['empresa_id'];

            $antigas = cacamba::where('empresa_id', '=', $empresa_id)->get();
            for ($i=0; $i < count($antigas); $i++) {
                $antigas[$i]->delete();
            }

            for ($i=0; $i < $dataForm['qtd']; $i++) {
                $cacamba = [
                    'status_cacamba_id' => $dataForm['status_cacamba_id'],
                    'empresa_id' => $dataForm['empresa_id'],
                    'codigo' => $i + 1
                ];
                $insert = $this->cacamba->create($cacamba);
            }
            if ($insert) {
                return redirect()->route('indexCacamba');
            } else {
                return redirect()->back();
            }
        }
    }

    public function update(cacambaFormRequest $request, $idCacamba)
    {
        $dataForm = $request->all();
        $cacamba = $this->cacamba->find($idCacamba);

        $update = $cacamba->update($dataForm);

        if ($update) {
            return redirect()->route('indexCacamba');
        } else {
            return redirect()->route('editCacamba', $idCacamba)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function alterarStatus()
    {
        $cacamba_id = request()->get('cacamba_id');
        $status_id = request()->get('status_id');

        $cacamba = cacamba::find($cacamba_id);
        $cacamba->status_cacamba_id = $status_id;
        $update = $cacamba->save();

        if ($update) {
            return ['ok' => true];
        } else {
            return ['ok' => false];
        }
    }
}
