<?php

namespace App\Http\Controllers;

use App\Http\Requests\permissaoFormRequest;
use App\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PermissaoController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissoes = Permission::orderBy('name')->paginate(10);
        return view('permissao.index', compact('permissoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param permissaoFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(permissaoFormRequest $request)
    {
        $permissao = new Permission();
        $permissao->name = $request->get('name');
        $permissao->display_name = $request->get('display_name');
        $permissao->description = $request->get('description');
        $permissao->save();
        return redirect()->route('permissao.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissao = Permission::find($id);
        return view('permissao.show', compact('permissao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissao = Permission::find($id);
        return view('permissao.edit', compact('permissao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param permissaoFormRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(permissaoFormRequest $request, $id)
    {
        $permissao = Permission::find($id);
        $permissao->name = $request->get('name');
        $permissao->display_name = $request->get('display_name');
        $permissao->description = $request->get('description');
        $permissao->save();
        return redirect()->route('permissao.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
