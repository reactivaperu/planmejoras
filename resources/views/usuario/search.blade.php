@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Busqueda de docentes</h1>
    <br/>
    <form class="" method="get" action="{{ url( '/usuarios/search' ) }}">
        <input placeholder="Buscar registro" id="texto" name="texto"/>
        <select id="criterio" name="criterio">
            <option value="users.name">Docente</option>
            <option value="accion_mejoras.nombre">Acción</option>
        </select>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Responsables</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $usuarios as $usuario )
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->nombre }}</td>               
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection