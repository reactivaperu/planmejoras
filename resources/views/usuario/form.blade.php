@if(isset($modo))
<h1>{{ $modo }} usuario</h1>
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
    <label for="name">Nombre</label>
    <input class="form-control" type="text" name="name" id="name" value="{{ isset($user->name)?$user->name:old('name') }}" placeholder="Nombre">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" type="email" name="email" id="email" value="{{ isset($user->email)?$user->email:old('email') }}" placeholder="Email">
</div>

<div class="form-group">
    <label for="tipo">Tipo</label>
    <select class="form-control" name="tipo" id="tipo" value="{{ isset($user->tipo)?$user->tipo:old('tipo') }}">
        <option value="Administrador" {{(isset($user->tipo)=='Administrador')?'selected':''}}>Administrador</option>
        <option value="Docentecomite" {{(isset($user->tipo)=='Docentecomite')?'selected':''}}>Docentecomite</option>
        <option value="Invitado" {{(isset($user->tipo)=='Invitado')?'selected':''}}>Invitado</option>
    </select>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('/usuarios') }}">Regresar</a>
<br>