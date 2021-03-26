<?php

namespace App\Http\Controllers;

use App\Http\Requests\statusFormRequest;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class StatusController extends Controller
{
    private $status;
    private $qtdShow = 10;

    public function __construct(status $status)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->status = $status;
    }

    public function index(Request $request)
    {
        $title = 'Listagem de Status';

        $status = $this->status;

        $filter = $request->get('filter');
        if ($filter)
            $status = $status->where('nome', 'LIKE', "%$filter%");
        $status = $status->orderBy('nome')->paginate($this->qtdShow);


        return view('status.index', compact('status', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Status";

        return view("status.create", compact('title'));
    }

    public function edit($idStatus)
    {
        $status = $this->status->find($idStatus);

        $title = "Editar Status: {$status->nome}";

        return view('status.create', compact('title', 'status'));
    }

    public function store(statusFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->status->create($dataForm);
        if ($insert) {
            return redirect()->route('indexStatus');
        } else {
            return redirect()->back();
        }
    }

    public function update(statusFormRequest $request, $idStatus)
    {
        $dataForm = $request->all();
        $status = $this->status->find($idStatus);

        $update = $status->update($dataForm);

        if ($update) {
            return redirect()->route('indexStatus');
        } else {
            return redirect()->route('editStatus', $idStatus)->with(['errors' => 'Falha ao editar']);
        }
    }
}
