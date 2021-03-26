<?php

namespace App\Http\Controllers;

use App\Models\prefeitura;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PrefeituraController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Cadastrar termo de compromisso';

        $prefeitura = prefeitura::first();

        return view('prefeitura.termoCompromisso', compact('title', 'prefeitura'));
    }

    public function store()
    {
        $prefeitura['termo_compromisso'] = request()->get('termo_compromisso');

        if (prefeitura::first()->update($prefeitura)) {
            return redirect()->back()->with('success', 'Termo de compromisso atualizado com sucesso');
        } else {
            return redirect()->back()->withErrors(['errors' => 'Não foi possível atualizar o Termo de compromisso']);
        }
    }
}