@extends('layouts.app')

@section('content')
<div class="container">


@if(Session::has('mensaje'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ Session::get('mensaje') }}</strong>
    </div>
@endif

<h1>PLANES DE MEJORA</h1>
<a href="{{ url('/planes/create') }}" class="btn btn-success">Registrar plan</a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Año</th>
            <th>Creador</th>
            <th>Avance</th>
            <th>Estado</th>
            <th>Ver plan</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $plan_mejoras as $plan )
        <tr>
            <td>{{ $plan->codigo }}</td>
            <td>{{ $plan->nombre }}</td>
            <td>{{ $plan->anio }}</td>
            <td>{{ $plan->name }}</td>
            <td>{{ $plan->avance }}</td>
            <td>{{ $plan->estado }}</td>
            <td class="text-center">
                <a href="{{ url('/planes/'.$plan->id.'/edit') }}" title="Ver plan"><i class="fas fa-search" style="color:#117a8b;font-size:20px;"></i></a>
            </td>
            <td class="text-center">
                <form method="post" action="{{ url( '/planes/'.$plan->id ) }}" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class='btn btn-default p-0' type='submit' value='submit' title="Eliminar Plan" onclick="return confirm('¿Quieres Borrar?')">
                        <i class="fas fa-minus-circle" style="color:red;font-size:22px;"></i>
                    </button> 
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $plan_mejoras->links() !!}

</div>
@endsection