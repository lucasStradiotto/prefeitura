<?php

namespace App\Http\Controllers;

use App\TiposAlerta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TiposAlertaController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $tiposAlerta = TiposAlerta::orderBy('tipo')->paginate(10);

        return view('tiposAlerta.index', compact('tiposAlerta'));
    }

    public function create()
    {
        return view('tiposAlerta.create');
    }

    public function store()
    {
        $tiposAlerta = new TiposAlerta();
        $tiposAlerta->tipo = request()->get('tipo');
        $tiposAlerta->push = (request()->has('push') && request()->get('push') == 'on') ? 1 : 0;
        $tiposAlerta->save();

        return redirect()->route('tiposAlerta.index');
    }
}
