<h3>Lista de actividades</h3>
@if(Session::has('mensaje'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ Session::get('mensaje') }}</strong>
    </div>
@endif

<a href="{{ url('/actividades/create/'.$idAccion) }}" class="btn btn-success">Agregar actividad</a>
<br>
<br>
@if(isset($actividades))
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Nombre</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Duracion</th>
            <th>Estado</th>
            <th>Archivo</th>
            <th>Ver</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $actividades as $actividad )
        <tr>
            <td>{{ $actividad->nombre }}</td>
            <td>{{ $actividad->fechaInicio }}</td>
            <td>{{ $actividad->fechaFin }}</td>
            <td>{{ $actividad->duracion }}</td>
            <td>{{ $actividad->estado }}</td>
            @if ($actividad->archivo  === "FALTA ARCHIVO")
            <td class="text-center">{{ $actividad->archivo }}</td>
            @else
            <td class="text-center m-0 p-0">
                <a href="{{ asset('storage/'.$actividad->archivo) }}" class="p-0 m-0" download="archivoActividad-{{isset($actividad->idAccion)?$actividad->idAccion:old('idAccion')}}.pdf">
                    <img src="{{url('/img/pdf.svg')}}" alt="Archivo PDF" class="img-fluid" width="30" height="30">
                </a>
            </td>
            @endif
            <td>
                <a href="{{ url('/actividades/'.$actividad->id.'/edit') }}" title="Ver actividad"><i class="fas fa-clipboard-list" style="color:#117a8b;font-size:20px;"></i></a>
            </td>
            <td>
                <form method="post" action="{{ url( '/actividades/'.$actividad->id ) }}" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class='btn btn-default p-0' type='submit' value='submit' title="Eliminar actividad" onclick="return confirm('¿Quieres Borrar?')">
                        <i class="fas fa-minus-circle" style="color:red;font-size:20px;"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $actividades->links() !!}
@endif