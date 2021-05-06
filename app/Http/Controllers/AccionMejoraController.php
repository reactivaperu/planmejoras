<?php

namespace App\Http\Controllers;

use App\Models\AccionMejora;
use App\Models\ActividadAccion;
use App\Models\User;
use App\Models\encargado_accion;

use App\Models\estandar;
use App\Models\estandar_accion;

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
        $users = User::all();
        return view('accionmejora.create',['idPlan'=>$idPlan],compact(['users']));
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
            'indicador' => 'required|string|max:255',
            'prioridad' => 'required|string|max:255'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosAccion = request()->except('_token');
        AccionMejora::insert($datosAccion);
        return redirect('planes/' . $datosAccion['idPlan'] . '/edit')->with('mensaje','Acción de mejora creada');
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
        $actividades = ActividadAccion::where('idAccion','=',$accion->id)->paginate(10);
        $users = User::all();
        $encargados = encargado_accion::where('idAccion','=',$accion->id)->get();

        
        $estandares = estandar::all();
        $estandares_accion = estandar_accion::where('idAccion','=',$accion->id)->get();

        return view('accionmejora.edit',compact(['accion','actividades','users','encargados','estandares','estandares_accion']));
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
        $datosAccion = request()->except(['_token','_method','encargados','estandares']);
        AccionMejora::where('id','=',$id)->update($datosAccion);

        $encargados = $request->input('encargados');
        encargado_accion::where('idAccion',$id)->delete();
        for ($i=0; $i < count($encargados); $i++) {
            $datoEncargado[] = [
                'idAccion'  => $id,
                'idUsuario' => $encargados[$i]
            ];
            encargado_accion::insert($datoEncargado);
        }

        $estandares = $request->input('estandares');
        estandar_accion::where('idAccion',$id)->delete();
        for ($i=0; $i < count($estandares); $i++) {
            $datoEstandares[] = [
                'idAccion'  => $id,
                'idEstandar' => $estandares[$i]
            ];
            estandar_accion::insert($datoEstandares);
        }

        return redirect('planes/' . $datosAccion['idPlan'] . '/edit')->with('mensaje','Accion de mejora modificada');
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
        return redirect()->back()->with('mensaje','Accion de mejora eliminada');
    }
}
