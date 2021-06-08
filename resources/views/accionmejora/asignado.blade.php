<?php use App\Http\Controllers\ActividadAccionController; ?>
<?php use App\Http\Controllers\EncargadoAccionController; ?>

@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Acciones de mejora asigandos</h1>
    <br/>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#Id</th>
                <th>Nombre</th>
                <th>Responsables</th>
                <th>Actividades</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $acciones as $accion )
            <tr>
                <td>{{ $accion->id }}</td>
                <td>{{ $accion->nombre }}</td>
                <td>
                    <?php echo EncargadoAccionController::index($accion->id);?>
                </td>
                <td>
                    <?php echo ActividadAccionController::index($accion->id);?>
                </td>                
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection