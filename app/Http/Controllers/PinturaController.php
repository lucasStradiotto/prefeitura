<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PinturaController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $permissoes = Permission::orderBy('name')->paginate(10);
        return view('permissao.index', compact('permissoes'));
    }
}
