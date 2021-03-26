<?php

namespace App\Http\Controllers;

use App\Models\Melhorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class MelhoriasController extends Controller
{
    private $melhorias;

    public function __construct(Melhorias $melhorias)
    {
        $this->melhorias = $melhorias;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Melhorias";
        $melhorias = $this->melhorias->paginate(10);
        return view('parametrosFiscalizacao.melhorias.index', compact('title', 'melhorias'));
    }

    public function create()
    {
        $title = "Criar Nova Melhoria";
        return view('parametrosFiscalizacao.melhorias.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_melhoria');

        $insert = $this->melhorias->create($form);

        if ($insert) {
            return redirect()->route('melhorias.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function edit($tipo_melhoria, $id)
    {
        $title = "Editar Melhoria";
        return view('parametrosFiscalizacao.melhorias.edit', compact('title', 'tipo_melhoria', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('melhorias')
            ->where('id', $request->get('id'))
            ->update(['tipo_melhoria' => $request->get('tipo_melhoria')]);

        if ($update) {
            return redirect()->route('melhorias.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('melhorias')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('melhorias.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
