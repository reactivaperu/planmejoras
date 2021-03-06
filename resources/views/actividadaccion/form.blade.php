@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul>
    @foreach($errors->all() as $error)
        <li> <strong> {{ $error }}! </strong> </li>
    @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-6 p-2">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="nombre" id="nombre" value="{{ isset($actividad->nombre)?$actividad->nombre:old('nombre') }}" placeholder="Nombre">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="descripcion" id="descripcion" value="{{ isset($actividad->descripcion)?$actividad->descripcion:old('descripcion') }}" placeholder="Descripcion">
        </div>

        <div class="form-group">
            <label for="fechaInicio">Fecha de Inicio</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="date" name="fechaInicio" id="fechaInicio" value="{{ isset($actividad->fechaInicio)?$actividad->fechaInicio:old('fechaInicio') }}">
        </div>

        <div class="form-group">
            <label for="fechaFin">Fecha de Fin</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="date" name="fechaFin" id="fechaFin" value="{{ isset($actividad->fechaFin)?$actividad->fechaFin:old('fechaFin') }}">
        </div>

        <div class="form-group" hidden>
            <label for="duracion">Duración (CALCULADO)</label>
            <input class="form-control" type="number" name="duracion" id="duracion" value="{{ isset($actividad->duracion)?$actividad->duracion:old('duracion') }}" placeholder="Duracion">
        </div>
    </div>
    <div class="col-6 p-2">
        <div class="form-group">
            <label for="estado">Estado</label>
            <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control" name="estado" id="estado" value="{{ isset($actividad->estado)?$actividad->estado:old('estado') }}">
                <option value="Iniciado" {{ isset($actividad->estado)? ($actividad->estado=='Iniciado'?'selected':'') : '' }}>Iniciado</option>
                <option value="Finalizado" {{ isset($actividad->estado)? ($actividad->estado=='Finalizado'?'selected':'') : '' }}>Finalizado</option>
                <option value="Cancelado" {{ isset($actividad->estado)? ($actividad->estado=='Cancelado'?'selected':'') : '' }}>Cancelado</option>
            </select>
        </div>
    </div>
</div>