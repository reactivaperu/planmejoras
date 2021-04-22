@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear acción de mejora</h1>
    <form method="post" enctype="nultipart/form-data" action="{{ url('/acciones') }}">
        @csrf
        @include('accionmejora.form')

        <div class="form-group">
            <label for="idPlan">Plan</label>
            <input class="form-control" type="text" name="idPlan" id="idPlan" value="{{ isset($idPlan)?$idPlan:old('idPlan') }}" placeholder="Plan">
        </div>
        
        <br>
        <input class="btn btn-success" type="submit" value="Guardar datos">
        <a class="btn btn-primary" href="{{ url()->previous() }}">Regresar</a>
    </form>
</div>
@endsection