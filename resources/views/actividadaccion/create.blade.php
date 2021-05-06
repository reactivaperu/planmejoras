@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear actividad</h1>
    <form method="post" enctype="multipart/form-data" action="{{ url('/actividades') }}">
        @csrf
        @include('actividadaccion.form')

        <div class="form-group">
            <label for="idAccion">Accion</label>
            <input class="form-control" type="text" name="idAccion" id="idAccion" value="{{ isset($idAccion)?$idAccion:old('idAccion') }}" placeholder="Plan">
        </div>
        
        <br>
        <input class="btn btn-success" type="submit" value="Guardar datos">
        <a class="btn btn-primary" href="{{ url()->previous() }}">Regresar</a>
    </form>
</div>
@endsection