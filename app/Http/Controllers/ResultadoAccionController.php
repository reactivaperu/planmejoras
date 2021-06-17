<?php

namespace App\Http\Controllers;

use App\Models\resultado_accion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultadoAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($idAccion)
    {
        //
        $datos['resultados'] = 
        DB::table('resultado_accions')
        ->join('resultados','resultado_accions.idResultado','=','resultados.id')
        ->where('resultado_accions.idAccion','=',$idAccion)
        ->groupBy(['resultado_accions.idAccion', 'resultado_accions.idResultado'])
        ->select('resultados.codigo')->paginate();
        return view('accionmejora.resultados',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\resultado_accion  $resultado_accion
     * @return \Illuminate\Http\Response
     */
    public function show(resultado_accion $resultado_accion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\resultado_accion  $resultado_accion
     * @return \Illuminate\Http\Response
     */
    public function edit(resultado_accion $resultado_accion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\resultado_accion  $resultado_accion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, resultado_accion $resultado_accion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\resultado_accion  $resultado_accion
     * @return \Illuminate\Http\Response
     */
    public function destroy(resultado_accion $resultado_accion)
    {
        //
    }
}
