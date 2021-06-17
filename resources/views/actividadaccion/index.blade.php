<h3>Lista de actividades</h3>
@if(Session::has('mensaje'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ Session::get('mensaje') }}</strong>
    </div>
@endif

@if(Auth::user()->tipo === 'Administrador')
<a href="{{ url('/actividades/create/'.$idAccion) }}" class="btn btn-success">Agregar actividad</a>
@endif

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
            @if(Auth::user()->tipo === 'Administrador')
            <th></th>
            <th></th>
            @endif
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
            @if(Auth::user()->tipo === 'Administrador')
            <td>
                <form method="post" action="{{ url( '/actividades/'.$actividad->id ) }}" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class='btn btn-default p-0' type='submit' value='submit' title="Eliminar actividad" onclick="return confirm('¿Quieres Borrar?')">
                        <i class="fas fa-minus-circle" style="color:red;font-size:20px;"></i>
                    </button>
                </form>
            </td>
            <td>
                <!-- Modal -->
                <div id="myModal-{{$actividad->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                    <form method="post" action="{{ url( '/actividades/'.$actividad->id ) }}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Observación</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <input class="form-control" type="text" name="observacion" id="observacion" value="{{ isset($actividad->observacion)?$actividad->observacion:old('observacion') }}" placeholder="Observación">
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <label for="idAccion">Accion</label>
                                <input class="form-control" type="text" name="idAccion" id="idAccion" value="{{ isset($actividad->idAccion)?$actividad->idAccion:old('idAccion') }}" placeholder="Accion">
                            </div>
                            <div class="modal-footer">
                                <button type='submit' value='submit' title="Guardar archivo" type="button" class="btn btn-primary" onclick="return confirm('¿Quieres Guardar?')">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                            </form>
                        </div>
                    </div>  
                </div>
                <!-- Modal -->
                <i class="fas fa-comment-alt" style="color:#343a40;font-size:20px;cursor:pointer;" data-toggle="modal" data-target="#myModal-{{$actividad->id}}"></i>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
{!! $actividades->links() !!}
@endif