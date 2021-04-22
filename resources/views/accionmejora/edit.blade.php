@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar plan de mejora</h1>
    <form action="{{ url( '/acciones/'.$accion->id ) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('accionmejora.form')

        <div class="form-group">
            <label for="idPlan">Plan</label>
            <input class="form-control" type="text" name="idPlan" id="idPlan" value="{{ isset($accion->idPlan)?$accion->idPlan:old('idPlan') }}" placeholder="Plan">
        </div>

        <br>
        <input class="btn btn-success" type="submit" value="Editar datos">
        <a class="btn btn-primary" href="{{ url()->previous() }}">Regresar</a>
    </form>
</div>
@endsection