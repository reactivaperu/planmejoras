<?php

namespace App\Http\Controllers;

use DateTime;
use Auth;
use App\Models\AccionMejora;
use App\Models\ActividadAccion;
use App\Models\User;
use App\Models\Resultado;
use App\Models\resultado_accion;
use App\Models\Indicador;
use App\Models\indicador_accion;
use App\Models\encargado_accion;

use App\Models\estandar;
use App\Models\estandar_accion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $resultados = Resultado::all();
        $indicadores = Indicador::all();
        return view('accionmejora.create',['idPlan'=>$idPlan],compact(['users','resultados','indicadores']));
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
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            //'resultado' => 'required|integer',
            'valor' => 'required|integer',
            'fechaInicio' => 'required|date|max:255',
            'fechaFin' => 'required|date|max:255',
            //'duracion' => 'required|integer',
            'semestreEjecucion' => 'required|string|max:255',
            'recursos' => 'required|string|max:255',
            'metas' => 'required|string|max:255',
            //'responsable' => 'required|integer',
            'estado' => 'required|string|max:255',
            'avance' => 'required|integer',
            //'indicador' => 'required|string|max:255',
            'prioridad' => 'required|string|max:255'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosAccion = request()->except('_token');

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
        $datosAccion['duracion']= $duracion;
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
        $userId = auth()->user()->id;
        $acciones = AccionMejora::where('responsable','=',$userId)->paginate(10);
        return view('accionmejora.asignado',compact(['acciones','userId']));
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
        
        //$users = User::all();
        $users = DB::select('SELECT U.id, U.name,(SELECT COUNT(AM.id) FROM accion_mejoras AM WHERE AM.responsable = U.id) AS acciones FROM users U');

        $encargados = encargado_accion::where('idAccion','=',$accion->id)->get();
        $estandares = estandar::all();
        $estandares_accion = estandar_accion::where('idAccion','=',$accion->id)->get();

        $resultados = Resultado::all();
        $resultados_accion = resultado_accion::where('idAccion','=',$accion->id)->get();
        
        $indicadores = Indicador::all();
        $indicadores_accion = indicador_accion::where('idAccion','=',$accion->id)->get();

        return view('accionmejora.edit',compact(['accion','actividades','users','encargados',
        'estandares','estandares_accion','resultados','indicadores','resultados_accion','indicadores_accion']));
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
        $datosAccion = request()->except(['_token','_method','encargados','estandares','resultados','indicadores']);
        
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
        $datosAccion['duracion']= $duracion;

        AccionMejora::where('id','=',$id)->update($datosAccion);

        $encargados = $request->input('encargados');
        if($encargados){
            encargado_accion::where('idAccion',$id)->delete();
            for ($i=0; $i < count($encargados); $i++) {
                $datoEncargado[] = [
                    'idAccion'  => $id,
                    'idUsuario' => $encargados[$i]
                ];
                encargado_accion::insert($datoEncargado);
            } 
            /* 
            $encargados = array_unique($encargados);
            $encargados_uni = [];
            for ($i=0; $i < count($encargados); $i++) {
                $noexiste = true;
                for ($j=0; $j < count($encargados_uni); $j++) { 
                    if($encargados[$i] !== $encargados_uni[$j]){
                        $noexiste = false;
                    }
                }
                if($noexiste){
                    array_push($encargados_uni, $encargados[$i]);      
                }
            }
            for ($i=0; $i < count($encargados_uni); $i++) {
                $datoEncargado[] = [
                    'idAccion'  => $id,
                    'idUsuario' => $encargados_uni[$i]
                ];
                encargado_accion::insert($datoEncargado);
            } */
        }

        $estandares = $request->input('estandares');
        if($estandares){
            estandar_accion::where('idAccion',$id)->delete();
            for ($i=0; $i < count($estandares); $i++) {
                $datoEstandares[] = [
                    'idAccion'  => $id,
                    'idEstandar' => $estandares[$i]
                ];
                estandar_accion::insert($datoEstandares);
            }
        }

        $resultados = $request->input('resultados');
        if($resultados){
            resultado_accion::where('idAccion',$id)->delete();
            for ($i=0; $i < count($resultados); $i++) {
                $datoResultados[] = [
                    'idAccion'  => $id,
                    'idResultado' => $resultados[$i]
                ];
                resultado_accion::insert($datoResultados);
            }
        }

        $indicadores = $request->input('indicadores');
        if($indicadores){
            indicador_accion::where('idAccion',$id)->delete();
            for ($i=0; $i < count($indicadores); $i++) {
                $datoIndicadores[] = [
                    'idAccion'  => $id,
                    'idIndicador' => $indicadores[$i]
                ];
                indicador_accion::insert($datoIndicadores);
            }
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
