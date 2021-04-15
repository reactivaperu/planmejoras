@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" enctype="nultipart/form-data" action="{{ url('/rol') }}">
        @csrf
        @include('rol.form',['modo'=>'Crear'])
    </form>
</div>
@endsection