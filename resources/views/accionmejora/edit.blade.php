@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ver acción de mejora</h1>
    <form action="{{ url( '/acciones/'.$accion->id ) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('accionmejora.form')
        
        <div class="form-group w-100">
            <label for="encargados">Encargados</label>
            <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control w-100" name="encargados[]" id="encargados" multiple="multiple">
                @if(isset($users))
                @foreach( $users as $user )
                <option value="{{ $user->id }}" 
                @if(isset($encargados))
                @foreach( $encargados as $encargado )
                    @if($encargado->idUsuario == $user->id)
                    selected
                    @endif
                @endforeach
                @endif
                >{{ $user->name }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <hr>

        <div class="form-group w-100">
            <label for="estandares">Estandares</label>
            <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control w-100" name="estandares[]" id="estandares" multiple="multiple">
                @if(isset($estandares))
                @foreach( $estandares as $estandar )
                <option value="{{ $estandar->id }}" 
                @if(isset($estandares_accion))
                @foreach( $estandares_accion as $estandaraccion )
                    @if($estandaraccion->idEstandar == $estandar->id)
                    selected
                    @endif
                @endforeach
                @endif
                >{{ '('.$estandar->estandar.')('.$estandar->dimension .')'. $estandar->denominacion }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="resultado">Resultados</label>
            <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control" name="resultados[]" id="resultados" multiple="multiple">
                @if(isset($resultados))
                @foreach( $resultados as $resultado )
                <option value="{{ $resultado->id }}" 
                @if(isset($resultados_accion))
                @foreach( $resultados_accion as $resultadoaccion )
                    @if($resultadoaccion->idResultado == $resultado->id)
                    selected
                    @endif
                @endforeach
                @endif
                >{{ $resultado->codigo.' - '.$resultado->detalle }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="indicadores">Indicadores</label>
            <select <?php echo Auth::user()->tipo==='Administrador'?'':'disabled';?> class="form-control" name="indicadores[]" id="indicadores" multiple="multiple">
                @if(isset($indicadores))
                @foreach( $indicadores as $indicador )
                <option value="{{ $indicador->id }}" 
                @if(isset($indicadores_accion))
                @foreach( $indicadores_accion as $indicadoraccion )
                    @if($indicadoraccion->idIndicador == $indicador->id)
                    selected
                    @endif
                @endforeach
                @endif
                >{{ $indicador->codigo.' - '.$indicador->detalle }}</option>
                @endforeach
                @endif
            </select>
        </div>
    
        <div class="form-group" hidden>
            <label for="idPlan">Plan</label>
            <input <?php echo Auth::user()->tipo==='Administrador'?'':'readonly';?> class="form-control" type="text" name="idPlan" id="idPlan" value="{{ isset($accion->idPlan)?$accion->idPlan:old('idPlan') }}" placeholder="Plan">
        </div>


        @if(Auth::user()->tipo === 'Administrador')
        <input class="btn btn-success" type="submit" value="Editar datos">
        @endif
        <a class="btn btn-primary" href="{{ url()->previous() }}">Regresar</a>
    </form>
    <br>
    <div class="">
        @include('actividadaccion.index',['idAccion' => $accion->id ])
    </div>
</div>
@endsection