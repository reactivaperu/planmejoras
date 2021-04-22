@extends('layouts.app')

@section('content')
<div class="container">


@if(Session::has('mensaje'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ Session::get('mensaje') }}</strong>
    </div>
@endif

<h1>USUARIOS</h1>
<a href="{{ url('/usuarios/create') }}" class="btn btn-success">Registrar usuario</a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $users as $user )
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->tipo }}</td>
            <td>
                <a href="{{url('/usuarios/'.$user->id.'/edit')}}" title="Editar Usuario"><i class="fas fa-user-edit" style="color:#ffc107;font-size:20px;"></i></a>
                <form method="post" action="{{ url( '/usuarios/'.$user->id ) }}" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class='btn btn-default' type='submit' value='submit' title="Eliminar Usuario" onclick="return confirm('¿Quieres Borrar?')">
                        <i class="fas fa-user-times" style="color:red;font-size:20px;"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $users->links() !!}

</div>
@endsection