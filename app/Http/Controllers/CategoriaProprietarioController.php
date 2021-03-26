<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProprietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class CategoriaProprietarioController extends Controller
{
    private $categorias;

    public function __construct(CategoriaProprietario $categorias)
    {
        $this->categorias = $categorias;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }


    public function index()
    {
        $title = "Categorias de Proprietarios";
        $categorias = $this->categorias->paginate(10);
        return view('parametrosFiscalizacao.catProprietario.index', compact('title', 'categorias'));
    }

    public function create()
    {
        $title = "Criar Nova Categoria";
        return view('parametrosFiscalizacao.catProprietario.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_categoria');

        $insert = $this->categorias->create($form);

        if ($insert) {
            return redirect()->route('catProprietario.index');
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function edit($tipo_categoria, $id)
    {
        $title = "Editar Categoria";
        return view('parametrosFiscalizacao.catProprietario.edit', compact('title', 'tipo_categoria', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('cat_proprietario')
            ->where('id', $request->get('id'))
            ->update(['tipo_categoria' => $request->get('tipo_categoria')]);

        if ($update) {
            return redirect()->route('catProprietario.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('cat_proprietario')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('catProprietario.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
