<?php

namespace App\Http\Controllers;

use App\Models\RevestExterno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RevestExternoController extends Controller
{

    private $revestimentos;

    public function __construct(RevestExterno $revestimentos)
    {
        $this->revestimentos = $revestimentos;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }


    public function index()
    {
        $title = "Revestimento Externo";
        $revestimentos = $this->revestimentos->paginate(10);
        return view('parametrosFiscalizacao.revestExterno.index', compact('title', 'revestimentos'));
    }

    public function create()
    {
        $title = "Criar Novo Revestimento";
        return view('parametrosFiscalizacao.revestExterno.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_revest');

        $insert = $this->revestimentos->create($form);

        if ($insert) {
            return redirect()->route('revestexterno.index');
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function edit($tipo_revest, $id)
    {
        $title = "Editar Revestimento Externo";
        return view('parametrosFiscalizacao.revestExterno.edit', compact('title', 'tipo_revest', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('revest_externo')
            ->where('id', $request->get('id'))
            ->update(['tipo_revest' => $request->get('tipo_revest')]);

        if ($update) {
            return redirect()->route('revestexterno.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('revest_externo')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('revestexterno.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
