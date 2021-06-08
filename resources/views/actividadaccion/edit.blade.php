@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Actividad de mejora</h1>
    <form action="{{ url( '/actividades/'.$actividad->id ) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('actividadaccion.form')

        <div class="form-group" hidden>
            <label for="idAccion">Accion</label>
            <input class="form-control" type="text" name="idAccion" id="idAccion" value="{{ isset($actividad->idAccion)?$actividad->idAccion:old('idAccion') }}" placeholder="Accion">
        </div>
        <br>
        @if(Auth::user()->tipo === 'Administrador')
        <input class="btn btn-success" type="submit" value="Editar datos">
        @endif
        <a class="btn btn-primary" href="{{ url()->previous() }}">Regresar</a>
    </form>
</div>
@endsection