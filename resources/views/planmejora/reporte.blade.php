@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Reporte de avance de plan de mejoras</h1>
    <br/>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Acción</th>
                <th>Responsables</th>
                <th>Avance</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $plan_mejoras as $plan )
            <tr>
                <td>{{ $plan->nombre }}</td>
                <td>{{ $plan->name }}</td>             
                <td>{{ $plan->avance }}</td>             
                <td>{{ $plan->estado }}</td>             
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection