<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Material;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiais = DB::table('material')->get();
        $title = 'Index Material';

        return view('material.index', compact('materiais', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $material = new Material;

        $material->material = $request->material;
        $material->marca = $request->marca;
        $material->modelo = $request->modelo;
        $material->codigo_fabricante = $request->codigo_fabricante;
        $material->unidade_compra = $request->unidade_compra;
        $material->unidade_movimento = $request->unidade_movimento;
        $material->fator_conversao = $request->fator_conversao;

        $material->save();

        return redirect('material');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        return view('material.details', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        return view('material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $material = Material::find($id);

        $material->material = $request->material;
        $material->marca = $request->marca;
        $material->modelo = $request->modelo;
        $material->codigo_fabricante = $request->codigo_fabricante;
        $material->unidade_compra = $request->unidade_compra;
        $material->unidade_movimento = $request->unidade_movimento;
        $material->fator_conversao = $request->fator_conversao;

        $material->update();

        return redirect('material');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::find($id);
        $material->delete();
        
        return redirect('material');
    }
}
