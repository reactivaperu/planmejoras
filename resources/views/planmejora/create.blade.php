@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear plan de mejora</h1>
    <div class="row">
        <div class="col-6 p-2">
            <form method="post" enctype="nultipart/form-data" action="{{ url('/planes') }}">
                @csrf
                @include('planmejora.form')
                <br>
                <input class="btn btn-success" type="submit" value="Guardar datos">
                <a class="btn btn-primary" href="{{ url('/planes') }}">Regresar</a>
            </form>
        </div>
        <div class="col-6 p-2"></div>
    </div>
</div>
@endsection