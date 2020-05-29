@extends('layout')

@section('content')

<h1>Subir archivo</h1>
@if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">{{Session::get('message')}}</h4>
    </div>
@endif
<form method="POST" action="{{route('subiendoArchivo')}}" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <label for="archivo"><b>Archivo: </b></label><br>
    <input type="file" name="archivo" required><br>
    <input class="btn btn-success" type="submit" value="Enviar">
</form>

@endsection