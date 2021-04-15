<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use ArrayObject;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['rols'] = Rol::paginate(1);
        return view('rol.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$datosRol = request()->all();
        $campos = [
            'nombre'=>'required|string|max:100',
            'descripcion'=>'required|string|max:200'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);

        $datosRol = request()->except('_token');
        Rol::insert($datosRol);
        //return response()->json($datosRol);
        return redirect('rol')->with('mensaje','Rol creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rol  $rol->id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $rol = Rol::findOrFail($id);
        return view('rol.edit',compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosRol = request()->except(['_token','_method']);
        Rol::where('id','=',$id)->update($datosRol);
        $rol = Rol::findOrFail($id);
        //return view('rol.edit',compact('rol'));
        return redirect('rol')->with('mensaje','Rol modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Rol::destroy($id);
        return redirect('rol');
    }
}
