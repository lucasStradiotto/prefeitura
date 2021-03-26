<?php

namespace App\Http\Controllers;

use App\Models\prefeitura;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class GraficoAbastecimentoController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Gráfico Abastecimento';
        $prefeitura = prefeitura::find(1);
        return view('graficoAbastecimento.index', compact('title', 'prefeitura'));
    }

    public function graficoKmLitro()
    {
        $title = 'Gráfico Km / Litro';
        $prefeitura = prefeitura::find(1);
        return view('graficoAbastecimento.grafico-km-litro', compact('title', 'prefeitura'));
    }
}
