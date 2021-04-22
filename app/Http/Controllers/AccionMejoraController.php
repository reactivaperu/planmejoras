<?php

namespace App\Http\Controllers;

use App\Models\AccionMejora;
use App\Models\ActividadAccion;
use Illuminate\Http\Request;

class AccionMejoraController extends Controller
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
    public function create($idPlan)
    {
        return view('accionmejora.create',['idPlan'=>$idPlan]);
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
            'idPlan' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'resultado' => 'required|integer',
            'valor' => 'required|integer',
            'fechaInicio' => 'required|date|max:255',
            'fechaFin' => 'required|date|max:255',
            'duracion' => 'required|integer',
            'semestreEjecucion' => 'required|string|max:255',
            'recursos' => 'required|string|max:255',
            'metas' => 'required|string|max:255',
            'responsable' => 'required|integer',
            'estado' => 'required|string|max:255',
            'avance' => 'required|string|max:255',
            'indicador' => 'required|string|max:255'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);

        $datosAccion = request()->except('_token');
        AccionMejora::insert($datosAccion);
        return redirect("planes")->with('mensaje','Acción de mejora creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccionMejora  $accionMejora
     * @return \Illuminate\Http\Response
     */
    public function show(AccionMejora $accionMejora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccionMejora  $accionMejora
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accion = AccionMejora::findOrFail($id);
        $actividad = ActividadAccion::where('idAccion','=',$accion->id)->paginate(10);
        return view('accionmejora.edit',compact(['accion','actividad']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccionMejora  $accionMejora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosAccion = request()->except(['_token','_method']);
        AccionMejora::where('id','=',$id)->update($datosAccion);
        return redirect('planes')->with('mensaje','Accion de mejora modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccionMejora  $accionMejora
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccionMejora::destroy($id);
        return redirect('planes')->with('mensaje','Accion de mejora eliminada');;
    }
}
