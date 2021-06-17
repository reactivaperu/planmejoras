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
            <label for="codigo">Codigo</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="codigo" id="codigo" value="{{ isset($accion->codigo)?$accion->codigo:old('codigo') }}" placeholder="Codigo">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="nombre" id="nombre" value="{{ isset($accion->nombre)?$accion->nombre:old('nombre') }}" placeholder="Nombre">
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="valor">Valor (%)</label>
                    <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="number" name="valor" id="valor" value="{{ isset($accion->valor)?$accion->valor:old('valor') }}" placeholder="Valor">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="prioridad">Prioridad</label>
                    <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control" name="prioridad" id="prioridad" value="{{ isset($accion->prioridad)?$accion->prioridad:old('prioridad') }}">
                        <option value="Alta" {{ isset($accion->prioridad)? ($accion->prioridad=='Alta' ? 'selected':'') : '' }}>Alta</option>
                        <option value="Media" {{ isset($accion->prioridad)? ($accion->prioridad=='Media' ? 'selected':'') :'' }}>Media</option>
                        <option value="Baja" {{ isset($accion->prioridad)? ($accion->prioridad=='Baja' ? 'selected':'') :'' }}>Baja</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="fechaInicio">Fecha de Inicio</label>
                    <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="date" name="fechaInicio" id="fechaInicio" value="{{ isset($accion->fechaInicio)?$accion->fechaInicio:old('fechaInicio') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="fechaFin">Fecha de Fin</label>
                    <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="date" name="fechaFin" id="fechaFin" value="{{ isset($accion->fechaFin)?$accion->fechaFin:old('fechaFin') }}">
                </div>
            </div>
        </div>
        <div class="form-group" hidden>
            <label for="duracion">Duración (CALCULADO)</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="number" name="duracion" id="duracion" value="{{ isset($accion->duracion)?$accion->duracion:old('duracion') }}" placeholder="Duracion">
        </div>
    </div>
    <div class="col-6 p-2">
            
        <div class="form-group">
            <label for="recursos">Recursos</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="recursos" id="recursos" value="{{ isset($accion->recursos)?$accion->recursos:old('recursos') }}" placeholder="Recursos">
        </div>

        <div class="form-group">
            <label for="metas">Metas</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="metas" id="metas" value="{{ isset($accion->metas)?$accion->metas:old('metas') }}" placeholder="Metas">
        </div>

        <div class="row">
            <div class="col-6">    
                <div class="form-group">
                    <label for="avance">Avance (%)</label>
                    <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="number" name="avance" id="avance" value="{{ isset($accion->avance)?$accion->avance:old('avance') }}" placeholder="0%">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control" name="estado" id="estado" value="{{ isset($accion->estado)?$accion->estado:old('estado') }}">
                        <option value="Iniciado" {{ isset($accion->estado)? ($accion->estado=='Iniciado'?'selected':'') : '' }}>Iniciado</option>
                        <option value="Finalizado" {{ isset($accion->estado)? ($accion->estado=='Finalizado'?'selected':'') : '' }}>Finalizado</option>
                        <option value="Cancelado" {{ isset($accion->estado)? ($accion->estado=='Cancelado'?'selected':'') : '' }}>Cancelado</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="semestreEjecucion">Semestre Ejecución</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="semestreEjecucion" id="semestreEjecucion" value="{{ isset($accion->semestreEjecucion)?$accion->semestreEjecucion:old('semestreEjecucion') }}" placeholder="Semestre Ejecución">
        </div>
    </div>
</div>

<hr>

<div class="form-group">
    <label for="responsable">Responsable</label>
    <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control" name="responsable" id="responsable">
        @if(isset($users))
        @foreach( $users as $user )
        <option value="{{ $user->id }}" {{ isset($accion->responsable)? ($accion->responsable==$user->id ? 'selected':'') : '' }} >{{ $user->name }} - N° Acciones ({{ $user->acciones }})</option>                
        @endforeach
        @endif
    </select>
</div>