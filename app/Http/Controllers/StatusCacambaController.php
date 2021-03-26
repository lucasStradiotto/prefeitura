<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusCacambaFormRequest;
use App\Models\StatusCacamba;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class StatusCacambaController extends Controller
{
    private $statusCacamba;
    private $qtdShow = 10;

    public function __construct(StatusCacamba $statusCacamba)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->statusCacamba = $statusCacamba;
    }

    public function index()
    {
        $title = 'Listagem de Status de Caçamba';
        $status = $this->statusCacamba->orderBy('descricao')->paginate($this->qtdShow);

        return view('statusCacamba.index', compact('status', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Status";

        return view("statusCacamba.create", compact('title'));
    }

    public function edit($idCacamba)
    {
        $status = $this->statusCacamba->find($idCacamba);

        $title = "Editar Status: {$status->descricao}";

        return view('statusCacamba.create', compact('title', 'status'));
    }

    public function store(StatusCacambaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->statusCacamba->create($dataForm);
        if ($insert) {
            return redirect()->route('indexStatusCacamba');
        } else {
            return redirect()->back();
        }
    }

    public function update(statusCacambaFormRequest $request, $idCacamba)
    {
        $dataForm = $request->all();
        $status = $this->statusCacamba->find($idCacamba);

        $update = $status->update($dataForm);

        if ($update) {
            return redirect()->route('indexStatusCacamba');
        } else {
            return redirect()->route('editStatusCacamba', $idCacamba)->with(['errors' => 'Falha ao editar']);
        }
    }
}