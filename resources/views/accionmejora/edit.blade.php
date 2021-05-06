@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar acción de mejora</h1>
    <form action="{{ url( '/acciones/'.$accion->id ) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('accionmejora.form')

        <div class="form-group w-100">
            <label for="encargados">Encargados</label>
            <select class="form-control w-100" name="encargados[]" id="encargados" multiple="multiple">
                @if(isset($users))
                @foreach( $users as $user )
                <option value="{{ $user->id }}" 
                @if(isset($encargados))
                @foreach( $encargados as $encargado )
                    @if($encargado->idUsuario == $user->id)
                    selected
                    @endif
                @endforeach
                @endif
                >{{ $user->name }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="form-group w-100">
            <label for="estandares">Estandares</label>
            <select class="form-control w-100" name="estandares[]" id="estandares" multiple="multiple">
                @if(isset($estandares))
                @foreach( $estandares as $estandar )
                <option value="{{ $estandar->id }}" 
                @if(isset($estandares_accion))
                @foreach( $estandares_accion as $estandaraccion )
                    @if($estandaraccion->idEstandar == $estandar->id)
                    selected
                    @endif
                @endforeach
                @endif
                >{{ '('.$estandar->estandar.')('.$estandar->dimension .')'. $estandar->denominacion }}</option>
                @endforeach
                @endif
            </select>
        </div>
        
        <div class="form-group" hidden>
            <label for="idPlan">Plan</label>
            <input class="form-control" type="text" name="idPlan" id="idPlan" value="{{ isset($accion->idPlan)?$accion->idPlan:old('idPlan') }}" placeholder="Plan">
        </div>

        <input class="btn btn-success" type="submit" value="Editar datos">
        <a class="btn btn-primary" href="{{ url()->previous() }}">Regresar</a>
    </form>
    <br>
    <div class="">
        @include('actividadaccion.index',['idAccion' => $accion->id ])
    </div>
</div>
@endsection