<ul>
  @foreach( $actividades as $actividad )

  <!-- Modal -->
  <div id="myModal-{{$actividad->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form method="post" action="{{ url( '/actividades/'.$actividad->id ) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Archivo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="d-flex flex-column justify-content-center align-items-center">
            @if($actividad->archivo !== "FALTA ARCHIVO")
              <a href="{{ asset('storage/'.$actividad->archivo) }}" class="text-center" download="archivoActividad-{{isset($actividad->idAccion)?$actividad->idAccion:old('idAccion')}}.pdf">
                <img src="{{url('/img/pdf.svg')}}" alt="Archivo PDF" class="img-fluid" width="30" height="30">
                <h5 class="m-2">Descargar Archivo</h5>
              </a>
              <label class="text-success mt-2" style="font-size:20px;">Cambiar Archivo <i class="fas fa-upload"></i></label>
              <input type="file" name="archivo" id="archivo">
            @else
              <label class="text-success" style="font-size:20px;">Subir Archivo <i class="fas fa-upload"></i></label>
              <input type="file" name="archivo" id="archivo">
            @endif
            </div>
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
  <li>
    {{ $actividad->nombre }}
    <i class="fas fa-search m-2" style="color:#117a8b;font-size:20px;cursor:pointer;" data-toggle="modal" data-target="#myModal-{{$actividad->id}}"></i>
  </li>
  @endforeach
</ul>

