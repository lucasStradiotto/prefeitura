<?php

namespace App\Http\Controllers;

use App\Http\Requests\perfilFormRequest;
use App\Role;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PerfilController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $perfis = Role::orderBy('name')->paginate(10);
        return view('perfil.index', compact('perfis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('perfil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param perfilFormRequest $request
     * @return Response
     */
    public function store(perfilFormRequest $request)
    {
        $role = new Role();
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        $role->save();
        return redirect()->route('perfil.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $perfil = Role::find($id);
        return view('perfil.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $perfil = Role::find($id);
        return view('perfil.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param perfilFormRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(perfilFormRequest $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        $role->save();
        return redirect()->route('perfil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
