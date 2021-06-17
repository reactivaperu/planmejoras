<h3>Lista de acciones</h3>
@if(Session::has('mensaje'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ Session::get('mensaje') }}</strong>
    </div>
@endif

@if(Auth::user()->tipo === 'Administrador')
<a href="{{ url('/acciones/create/'.$idPlan) }}" class="btn btn-success">Agregar acción</a>
@endif

<br>
<br>
@if(isset($acciones))
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Nombre</th>
            <th>Duracion</th>
            <th>Avance</th>
            <th>Ver</th>
            @if(Auth::user()->tipo === 'Administrador')
            <th></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach( $acciones as $accion )
        <tr>
            <td>{{ $accion->nombre }}</td>
            <td>{{ $accion->duracion }}</td>
            <td>{{ $accion->avance }}%</td>
            <td>
                <a href="{{ url('/acciones/'.$accion->id.'/edit') }}" title="Ver accion"><i class="fas fa-clipboard-list" style="color:#117a8b;font-size:20px;"></i></a>
            </td>
            @if(Auth::user()->tipo === 'Administrador')
            <td>
                <form method="post" action="{{ url( '/acciones/'.$accion->id ) }}" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class='btn btn-default p-0' type='submit' value='submit' title="Eliminar accion" onclick="return confirm('¿Quieres Borrar?')">
                        <i class="fas fa-minus-circle" style="color:red;font-size:20px;"></i>
                    </button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
{!! $acciones->links() !!}
@endif