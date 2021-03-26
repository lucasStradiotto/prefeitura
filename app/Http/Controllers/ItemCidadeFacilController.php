<?php

namespace App\Http\Controllers;


use App\Http\Requests\itemCidadeFacilFormRequest;
use App\Models\ItemCidadeFacil;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ItemCidadeFacilController extends Controller
{
    private $item;
    private $qtdShow = 10;

    public function __construct(ItemCidadeFacil $item)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->item = $item;
    }

    public function index()
    {

        $title = 'Listagem de Itens Cidade Fácil';
        $itens = $this->item->orderBy('display_name')->paginate($this->qtdShow);

        return view('itemCidadeFacil.index', compact('itens', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Item Cidade Fácil";

        return view("itemCidadeFacil.create", compact('title'));
    }

    public function edit($idItem)
    {
        $item = $this->item->find($idItem);

        $title = "Editar Item: {$item->display_name}";

        return view('itemCidadeFacil.create', compact('title', 'item'));
    }

    public function store(itemCidadeFacilFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->item->create($dataForm);
        if ($insert) {
            return redirect()->route('indexItemCidadeFacil');
        } else {
            return redirect()->back();
        }
    }

    public function update(itemCidadeFacilFormRequest $request, $idItem)
    {
        $dataForm = $request->all();
        $item = $this->item->find($idItem);

        $update = $item->update($dataForm);

        if ($update) {
            return redirect()->route('indexItemCidadeFacil');
        } else {
            return redirect()->route('editItemCidadeFacil', $idItem)->with(['errors' => 'Falha ao editar']);
        }
    }
}

