<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Categoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CategoriaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Categoria';
        $categorias = Categoria::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.categoria.index', compact('categorias', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Categoria";

        return view("parametrosFiscalizacao.categoria.create", compact('title'));
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);

        $title = "Editar Forro: {$categoria->descricao}";

        return view('parametrosFiscalizacao.categoria.create', compact('title', 'categoria'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Categoria::create($dataForm);
        if ($insert) {
            return redirect()->route('indexCategoria');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $categoria = Categoria::find($id);

        $update = $categoria->update($dataForm);

        if ($update) {
            return redirect()->route('indexCategoria');
        } else {
            return redirect()->route('editCategoria', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $categoria = Categoria::find($id);

        $delete = $categoria->delete();
        if ($delete){
            return redirect()->route('indexCategoria')->with("message", "$categoria->descricao excluído.");
        } else {
            return redirect()->route('indexCategoria')->with("error", "Falha ao deletar");
        }
    }
}