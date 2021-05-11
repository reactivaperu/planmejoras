<?php

namespace App\Http\Controllers;

use DateTime;
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
            //'duracion' => 'required|integer',
            'estado' => 'required|string|max:255',
            //'archivo' => 'required|string|max:255'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosActividad = request()->except('_token');
        if($request->hasFile('archivo')){
            $datosActividad['archivo'] = $request->file('archivo')->store('uploads','public');
        } else { $datosActividad['archivo'] = 'FALTA ARCHIVO'; }
        
        $fdate = $request->fechaInicio;
        $tdate = $request->fechaFin;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $daysDiff = $interval->format('%a');//now do whatever you like with $days
        $semanas = floor($daysDiff / 7);
        $days = floor($daysDiff % 7);
        $duracion = $semanas.' semana(s)';
        if($days>0){ $duracion = $duracion.' con '.$days.' dias.'; }
        $datosActividad['duracion']= $duracion;

        ActividadAccion::insert($datosActividad);
        return redirect('acciones/' . $datosActividad['idAccion'] . '/edit')->with('mensaje','Actividad de mejora creada');
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
        
        $fdate = $request->fechaInicio;
        $tdate = $request->fechaFin;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $daysDiff = $interval->format('%a');//now do whatever you like with $days
        $semanas = floor($daysDiff / 7);
        $days = floor($daysDiff % 7);
        $duracion = $semanas.' semana(s)';
        if($days>0){ $duracion = $duracion.' con '.$days.' dias.'; }
        $datosActividad['duracion']= $duracion;

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
