<?php

namespace App\Http\Controllers;

use App\Models\PlanMejora;
use App\Models\AccionMejora;
use Illuminate\Http\Request;

class PlanMejoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['plan_mejoras'] = PlanMejora::paginate(10);
        return view('planmejora.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('planmejora.create');
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
            'codigo'=>'required|string|max:10',
            'nombre'=>'required|string|max:255',
            'anio'=>'required|integer',
            'creador'=>'required|integer',
            'avance'=>'required|integer',
            'estado'=>'required|string|max:255'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);

        $datosPlan = request()->except('_token');
        PlanMejora::insert($datosPlan);
        return redirect('planes')->with('mensaje','Plan de mejora creado creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanMejora  $planMejora
     * @return \Illuminate\Http\Response
     */
    public function show(PlanMejora $planMejora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanMejora  $planMejora
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $plan = PlanMejora::findOrFail($id);
        $acciones = AccionMejora::where('idPlan','=',$plan->id)->paginate(10);
        return view('planmejora.edit',compact(['plan','acciones']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanMejora  $planMejora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosPlan = request()->except(['_token','_method']);
        PlanMejora::where('id','=',$id)->update($datosPlan);
        return redirect('planes')->with('mensaje','Plan de mejora modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanMejora  $planMejora
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PlanMejora::destroy($id);
        return redirect('planes');
    }
}
