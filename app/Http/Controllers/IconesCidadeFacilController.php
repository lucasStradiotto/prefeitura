<?php

namespace App\Http\Controllers;

use App\Models\iconesCidadeFacil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Image;
use Illuminate\Support\Facades\Response;

class IconesCidadeFacilController extends Controller
{
    private $icone;
    private $qtdShow = 10;

    public function __construct(iconesCidadeFacil $icone)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->icone = $icone;
    }

    public function index()
    {
        $title = 'Ícones';
        $icones = $this->icone->orderBy('nome')->paginate($this->qtdShow);

        return view('iconesCidadeFacil.index', compact('icones', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Ícone";

        return view("iconesCidadeFacil.create", compact('title'));
    }

    public function edit($idIcone)
    {
        $icone = $this->icone->find($idIcone);

        $title = "Editar Ícone: {$icone->display_name}";

        return view('iconesCidadeFacil.create', compact('title', 'icone'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();

        if (isset($dataForm["icone"]))
        {
            $img = $dataForm["icone"];
            $extension = $img->getClientOriginalExtension();

            if (($extension == "png") ||
                ($extension == "PNG") ||
                ($extension == "jpg") ||
                ($extension == "JPG"))
            {
                $pic = Image::make($img);
                Response::make($pic->encode($extension));
                $dataForm["icone"] = $pic;
            }
        }
                $insert = $this->icone->create($dataForm);
                if ($insert) {
                    return redirect()->route('indexIconesCidadeFacil');
                } else {
                    return redirect()->back();
                }
    }

        public function update(Request $request, $idIcone)
    {
        $dataForm = $request->all();
        $icone = $this->icone->find($idIcone);

        if (isset($dataForm["icone"]))
        {
            $img = $dataForm["icone"];
            $extension = $img->getClientOriginalExtension();

            if (($extension == "png") ||
                ($extension == "PNG") ||
                ($extension == "jpg") ||
                ($extension == "JPG"))
            {
                $pic = Image::make($img);
                Response::make($pic->encode($extension));
                $dataForm["icone"] = $pic;
            }
        }

        $update = $icone->update($dataForm);

        if ($update) {
            return redirect()->route('indexIconesCidadeFacil');
        } else {
            return redirect()->route('editIconesCidadeFacil', $idIcone)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function downloadIcone(Request $request)
    {
        $id = $request->all()["icone_id"];
        $imagem = Image::make(iconesCidadeFacil::find($id)->icone);
        $response = \Response::make($imagem->encode('data-url'));

        return $response;
    }
}