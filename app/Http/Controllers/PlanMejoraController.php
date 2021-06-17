<?php

namespace App\Http\Controllers;

use App\Models\PlanMejora;
use App\Models\AccionMejora;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanMejoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->tipo === 'Administrador'){
            $datos['plan_mejoras'] = DB::table('plan_mejoras')->join('users','plan_mejoras.creador','=','users.id')->select('plan_mejoras.*','users.name')->paginate(10);
        } else {
            $datos['plan_mejoras'] = 
            DB::table('plan_mejoras')
            ->join('users','plan_mejoras.creador','=','users.id')
            ->where('plan_mejoras.estado','<>','No Aprobado')
            ->select('plan_mejoras.*','users.name')->paginate(10);
        }
        return view('planmejora.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('planmejora.create',compact(['users']));
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
        return redirect('planes')->with('mensaje','Plan de mejora creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanMejora  $planMejora
     * @return \Illuminate\Http\Response
     */
    public function show(PlanMejora $planMejora)
    {
        $datos['accion_mejoras'] = DB::table('accion_mejoras')
        ->join('users','accion_mejoras.responsable','=','users.id')
        ->select('accion_mejoras.*','users.name')->paginate(10);
        return view('planmejora.reporte', $datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanMejora  $planMejora
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $users = User::all();
        $plan = PlanMejora::findOrFail($id);
        $acciones = AccionMejora::where('idPlan','=',$plan->id)->paginate(10);
        return view('planmejora.edit',compact(['plan','acciones','users']));
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
