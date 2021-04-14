Crear un nuevo rol
<form method="post" enctype="nultipart/form-data" action="{{ url('/rol') }}">
    @csrf
    @include('rol.form')
</form>