<?php

namespace App\Http\Controllers;

use App\Http\Requests\cartaoMestreFormRequest;
use App\Models\cartaoMestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CartaoMestreController extends Controller
{
    public function __construct(cartaoMestre $cartaoMestre)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->cartaoMestre = $cartaoMestre;
    }

    public function index()
    {
        $title = 'Listagem de Cartões Mestre';
        $cartaoMestres = $this->cartaoMestre->all();

        return view('cartaoMestre.index', compact('cartaoMestres', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Cartão Mestre";

        return view("cartaoMestre.create", compact('title'));
    }

    public function edit($idCartaoMestre)
    {
        $cartaoMestre = $this->cartaoMestre->find($idCartaoMestre);

        $title = "Editar Cartão Mestre: {$cartaoMestre->numero}";

        return view('cartaoMestre.create', compact('title', 'cartaoMestre'));
    }

    public function store(cartaoMestreFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->cartaoMestre->create($dataForm);
        if ($insert) {
            return redirect()->route('indexCartaoMestre');
        } else {
            return redirect()->back();
        }
    }

    public function update(cartaoMestreFormRequest $request, $idCartaoMestre)
    {
        $dataForm = $request->all();
        $cartaoMestre = $this->cartaoMestre->find($idCartaoMestre);

        $update = $cartaoMestre->update($dataForm);

        if ($update) {
            return redirect()->route('indexCartaoMestre');
        } else {
            return redirect()->route('editCartaoMestre', $idCartaoMestre)->with(['errors' => 'Falha ao editar']);
        }
    }
}
