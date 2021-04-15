@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url( '/rol/'.$rol->id ) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('rol.form',['modo'=>'Editar'])
    </form>
</div>
@endsection