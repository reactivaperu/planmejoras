<?php

namespace App\Http\Controllers;

use App\Models\encargado_accion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EncargadoAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($idAccion)
    {
        //
        $datos['encargados'] = DB::table('encargado_accions')->join('users','encargado_accions.idUsuario','=','users.id')->where('encargado_accions.idAccion','=',$idAccion)->select('users.name')->paginate();
        return view('usuario.encargados',$datos);
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
     * @param  \App\Models\encargado_accion  $encargado_accion
     * @return \Illuminate\Http\Response
     */
    public function show(encargado_accion $encargado_accion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\encargado_accion  $encargado_accion
     * @return \Illuminate\Http\Response
     */
    public function edit(encargado_accion $encargado_accion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\encargado_accion  $encargado_accion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, encargado_accion $encargado_accion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\encargado_accion  $encargado_accion
     * @return \Illuminate\Http\Response
     */
    public function destroy(encargado_accion $encargado_accion)
    {
        //
    }
}
