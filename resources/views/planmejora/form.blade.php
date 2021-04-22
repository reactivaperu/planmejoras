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
    <label for="codigo">Codigo</label>
    <input class="form-control" type="text" name="codigo" id="codigo" value="{{ isset($plan->codigo)?$plan->codigo:old('codigo') }}" placeholder="Codigo">
</div>

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ isset($plan->nombre)?$plan->nombre:old('nombre') }}" placeholder="Nombre">
</div>

<div class="form-group">
    <label for="anio">Año</label>
    <input class="form-control" type="number" name="anio" id="anio" value="{{ isset($plan->anio)?$plan->anio:old('anio') }}" placeholder="Año">
</div>

<div class="form-group">
    <label for="creador">Creador</label>
    <input class="form-control" type="number" name="creador" id="creador" value="{{ isset($plan->creador)?$plan->creador:old('creador') }}" placeholder="Creador">
</div>

<div class="form-group">
    <label for="avance">Avance</label>
    <input class="form-control" type="number" name="avance" id="avance" value="{{ isset($plan->avance)?$plan->avance:old('avance') }}" placeholder="Avance">
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <input class="form-control" type="text" name="estado" id="estado" value="{{ isset($plan->estado)?$plan->estado:old('estado') }}" placeholder="Estado">
</div>