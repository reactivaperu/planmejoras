@extends('layouts.app')

@section('content')
<div class="container">


@if(Session::has('mensaje'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ Session::get('mensaje') }}</strong>
    </div>
@endif

<h1>ROLES</h1>
<a href="{{ url('/roles/create') }}" class="btn btn-success">Registrar rol</a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $rols as $rol )
        <tr>
            <td>{{ $rol->id }}</td>
            <td>{{ $rol->nombre }}</td>
            <td>{{ $rol->descripcion }}</td>
            <td>
                <a href="{{ url('/roles/'.$rol->id.'/edit') }}" class="btn btn-warning">EDITAR</a>
                |
                <form method="post" action="{{ url( '/roles/'.$rol->id ) }}" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" value="BORRAR" onclick="return confirm('¿Quieres Borrar?')" class="btn btn-danger">    
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $rols->links() !!}
</div>
@endsection