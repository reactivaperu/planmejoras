@if(isset($modo))
<h1>{{ $modo }} rol</h1>
@endif

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

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ isset($rol->nombre)?$rol->nombre:old('nombre') }}" placeholder="Nombre">
</div>


<div class="form-group">
    <label for="descripcion">Descripción</label>
    <input class="form-control" type="text" name="descripcion" id="descripcion" value="{{ isset($rol->descripcion)?$rol->descripcion:old('descripcion') }}" placeholder="Descripción">
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('/roles') }}">Regresar</a>
<br>