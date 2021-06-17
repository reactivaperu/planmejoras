<?php use App\Http\Controllers\ResultadoAccionController; ?>

@extends('layouts.app')
@section('content')
<div class="mx-5">
    <h1>Reporte de avance de plan de mejoras</h1>
    <br/>
    <table class="table table-striped">
        <thead class="thead-dark text-center">
            <tr>
                <th>CODIGO</th>
                <th>RESULTADO</th>
                <th>VALOR</th>
                <th>ACCIÓN DE MEJORA</th>
                <th>SEMESTRE DE EJECUCIÓN</th>
                <th>DURACIÓN</th>
                <th>RECURSOS NECESARIOS</th>
                <th>METAS</th>
                <th>RESPONSABLES</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $accion_mejoras as $accion )
            <tr class="text-center">
                <td>{{ $accion->codigo }}</td>
                <td>
                    <?php echo ResultadoAccionController::index($accion->id);?> 
                </td>
                <td>{{ $accion->valor }}%</td>
                <td>{{ $accion->nombre }}</td>
                <td>{{ $accion->semestreEjecucion }}</td>
                <td>{{ $accion->duracion }}</td>
                <td>{{ $accion->recursos }}</td>
                <td>{{ $accion->metas }}</td>
                <td>{{ $accion->name }}</td>
                <td>{{ $accion->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection