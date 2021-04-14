Mostar lista de roles
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
                <a href="{{ url('/rol/'.$rol->id.'/edit') }}">EDITAR</a>
                <form method="post" action="{{ url( '/rol/'.$rol->id ) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" value="BORRAR" onclick="return confirm('¿Quieres Borrar?')">    
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>