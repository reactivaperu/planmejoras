@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar plan de mejora</h1>
    <div class="row">
        <div class="col-6 p-2">
            <form action="{{ url( '/planes/'.$plan->id ) }}" method="post">
                @csrf
                {{ method_field('PATCH') }}
                @include('planmejora.form')
                <br>
                <input class="btn btn-success" type="submit" value="Editar datos">
                <a class="btn btn-primary" href="{{ url('/planes') }}">Regresar</a>
            </form>
        </div>
        <div class="col-6 p-2">
            @include('accionmejora.index',['idPlan' => $plan->id ])
        </div>
    </div>    
</div>
@endsection