<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['users'] = User::paginate(10);
        return view('usuario.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
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
            'name'=>'required|string|max:100',
            'email'=>'required|string|max:200',
            'tipo'=>'required|string|max:200'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            "descripcion.required"=>'La descripcion es requerida'
        ];
        $this->validate($request,$campos,$mensaje);

        $datosUser = request()->except('_token');
        User::insert($datosUser);
        return redirect('usuarios')->with('mensaje','Usuario creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $user = User::findOrFail($id);
        return view('usuario.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosUser = request()->except(['_token','_method']);
        User::where('id','=',$id)->update($datosUser);
        return redirect('usuarios')->with('mensaje','Usuario modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('usuarios');
    }

    public function search()
    {
        $texto = $_GET['texto'];
        $criterio = $_GET['criterio'];
        $datos['texto'] = $texto;
        $datos['criterio'] = $criterio;

        if($criterio==='users.name'){
            $datos['usuarios'] = DB::table('users')
            ->join('accion_mejoras','accion_mejoras.responsable','=','users.id')
            ->where(''.$criterio,'LIKE','%'.$texto.'%')
            ->orderBy(''.$criterio)
            ->select('users.name','accion_mejoras.*')->paginate(10);
        } else {
            $datos['usuarios'] = DB::table('users')
            ->join('accion_mejoras','accion_mejoras.responsable','=','users.id')
            ->where(''.$criterio,'LIKE','%'.$texto.'%')
            ->orderByDesc(''.$criterio)
            ->select('users.name','accion_mejoras.*')->paginate(10);
        }
        
        return view('usuario.search',$datos);
    }
}
