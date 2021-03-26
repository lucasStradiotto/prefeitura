<?php

namespace App\Http\Controllers;

use App\Models\cercasEletronica;
use App\Models\poligono;
use App\Models\verticesCerca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class VerticesPoligonoController extends Controller
{
    private $poligono;
    private $verticesCerca;

    public function __construct(poligono $poligono, verticesCerca $verticesCerca)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->poligono = $poligono;
        $this->verticesCerca = $verticesCerca;
    }

    public function create()
    {
        $title = "Cadastrar Vértices de Cerca";
        $poligonos = $this->poligono->all();

        return view("verticeCerca.create", compact('title', 'poligonos'));
    }

    public function show()
    {
        $title = "Polígonos";
        $poligonos = $this->poligono->orderBy('nome')->get();
        return view('verticeCerca.show', compact('title', 'poligonos'));
    }

    public function draw()
    {
        $title = "Poligonos";
//        $cerca_id = $request["cerca_id"];
//        $vertices = $this->verticesCerca->where('cerca_id', '=', $cerca_id)->get();
//        $cercas = $this->verticesCerca->select('cerca_id')->distinct()->get();
//        $cercasToSend = "";
//        foreach ($cercas as $cerca)
//        {
//            $cercasToSend.=$cerca->cerca_id.',';
//        }
//        if (count($vertices) > 0)
//        {
//            $latitudes = [];
//            $longitudes = [];
//            foreach ($vertices as $vertice)
//            {
//                array_push($latitudes, $vertice->latitude);
//                array_push($longitudes, $vertice->longitude);
//            }
        return view('verticeCerca.drawPolygon', compact('title'));
//        }
//        else
//        {
//            return redirect()->back()->withErrors(["error"=>"Esta cerca não possui vértices cadastradas"]);
//        }
    }

    public function setPoints(Request $request)
    {
        $title = "Cadastrar Vértices";
        $poligono = $request["tipo_poligono_id"];
        $poligono = $this->poligono->find($poligono);

        return view('verticeCerca.newsetPoints', compact('title', 'poligono'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $poligono_id = $dataForm["tipo_poligono_id"];
        $latitudes = $dataForm["latitude"];
        $longitudes = $dataForm["longitude"];

        for ($i = 0; $i < count($latitudes); $i++) {
            if ($latitudes[$i] && $longitudes[$i]) {
                $vertice = new verticesCerca();
                $vertice->cerca_id = $poligono_id;
                $vertice->latitude = $latitudes[$i];
                $vertice->longitude = $longitudes[$i];
                $vertice->save();
            }
        }
        if ($vertice) {
            return redirect()->route('createVerticeCerca');
        } else {
            return redirect()->back();
        }
    }

    public function storeVertices(Request $request)
    {
        $dataForm = $request->all();
        $poligono_id = $dataForm["poligono_id"];
        $latitudes = $dataForm["latitudes"];
        $longitudes = $dataForm["longitudes"];
		$indexes = $dataForm["indexes"];
        $latitudes = explode(',', $latitudes[0]);
        $longitudes = explode(',', $longitudes[0]);
		$indexes = explode(',', $indexes[0]);
        // dd($latitudes);
        
        $verticesAntigas = $this
            ->verticesCerca
            ->where('poligono_id', '=', $poligono_id)
            ->get();
        foreach ($verticesAntigas as $vertice) {
            $delete = $vertice->delete();
        }
		
        for ($i = 0; $i < count($latitudes); $i++) {
            if ($latitudes[$i] && $longitudes[$i]) {
                $vertice = new verticesCerca();
                $vertice->poligono_id = $poligono_id;
                $vertice->latitude = $latitudes[$i];
                $vertice->longitude = $longitudes[$i];
				$vertice->index = intval($indexes[$i]);
                $vertice->save();
            }
        }
        if ($vertice) {
            return redirect()->route('showVerticeCerca');
        } else {
            return redirect()->back();
        }
    }

    public function getVertices()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `vertices_cerca`.`latitude` as lat, `vertices_cerca`.`longitude` as lng,
                              `poligonos`.`cerca_area_risco` as risco 
                        FROM `vertices_cerca` 
                        INNER JOIN `poligonos`
                        ON `poligonos`.`id` = `vertices_cerca`.`tipo_poligono_id`
                        WHERE `poligono_id` = ?"
                ),
                array(
                    request()->get('poligono_id'),
                )
            )
        );
    }

    public function getIdsVertices()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT DISTINCT poligono_id FROM vertices_cerca"
                ),
                array()
            )
        );
    }
}
