<?php

namespace App\Http\Controllers;

use App\Models\PinturaInt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PinturaIntController extends Controller
{
    private $pinturas;

    public function __construct(PinturaInt $pinturas)
    {
        $this->pinturas = $pinturas;
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Pinturas Internas";
        $pinturas = $this->pinturas->paginate(10);
        return view('parametrosFiscalizacao.pinturaInt.index', compact('title', 'pinturas'));
    }

    public function create()
    {
        $title = "Criar Nova Pintura";
        return view('parametrosFiscalizacao.pinturaInt.create', compact('title'));
    }


    public function store(Request $request)
    {
        $form = $request->only('tipo_pintura');

        $insert = $this->pinturas->create($form);

        if ($insert) {
            return redirect()->route('pinturaInt.index');
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function edit($tipo_pintura, $id)
    {
        $title = "Editar Pintura Interna";
        return view('parametrosFiscalizacao.pinturaInt.edit', compact('title', 'tipo_pintura', 'id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('pintura_int')
            ->where('id', $request->get('id'))
            ->update(['tipo_pintura' => $request->get('tipo_pintura')]);

        if ($update) {
            return redirect()->route('pinturaInt.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $update = DB::table('pintura_int')
            ->where('id', $id)
            ->delete();

        if ($update) {
            return redirect()->route('pinturaInt.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
