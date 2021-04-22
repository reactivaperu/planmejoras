@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" enctype="nultipart/form-data" action="{{ url('/usuarios') }}">
        @csrf
        @include('usuario.form',['modo'=>'Crear'])
    </form>
</div>
@endsection