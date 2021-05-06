<?php

namespace App\Http\Controllers;

use App\Models\ActividadAccion;
use Illuminate\Http\Request;

class ActividadAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idAccion)
    {
        return view('actividadaccion.create',['idAccion'=>$idAccion]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'idAccion' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'fechaInicio' => 'required|date|max:255',
            'fechaFin' => 'required|date|max:255',
            'duracion' => 'required|integer',
            'estado' => 'required|string|max:255',
            //'archivo' => 'required|string|max:255'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosAccion = request()->except('_token');
        if($request->hasFile('archivo')){
            $datosAccion['archivo'] = $request->file('archivo')->store('uploads','public');
        } else { $datosAccion['archivo'] = 'FALTA ARCHIVO'; }
        ActividadAccion::insert($datosAccion);
        return redirect('acciones/' . $datosAccion['idAccion'] . '/edit')->with('mensaje','Actividad de mejora creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActividadAccion  $actividadAccion
     * @return \Illuminate\Http\Response
     */
    public function show(ActividadAccion $actividadAccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActividadAccion  $actividadAccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividad = ActividadAccion::findOrFail($id);
        return view('actividadaccion.edit',compact(['actividad']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActividadAccion  $actividadAccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosActividad = request()->except(['_token','_method']);
        ActividadAccion::where('id','=',$id)->update($datosActividad);
        return redirect('acciones/' . $datosActividad['idAccion'] . '/edit')->with('mensaje','Actividad mejora modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActividadAccion  $actividadAccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ActividadAccion::destroy($id);
        return redirect()->back()->with('mensaje','Actividad de mejora eliminada');;
    }
}
