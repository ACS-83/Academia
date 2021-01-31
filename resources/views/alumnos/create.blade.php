@extends('plantillas.plantilla1')
@section('titulo')
Nuevo Alummo
@endsection
@section('cabecera')
Registrar de un Alumno
@endsection
@section('contenido')
{{-- Esto esta en la pagina de laravel y validacion, lo hemos sacado de ahi --}}
@if ($errors->any())
    <div class="alert alert-danger my-3 p-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('alumnos.store')}}" name="formulario" method="post" enctype="multipart/form-data" class="mt-3">
    @csrf
    <div class="row m-3">
        <div class="col-2">
            <input type="text" name="nombre" required placeholder="Nombre" class="form-control">
        </div>
        <div class="col-5">
            <input type="text" name="apellidos" placeholder="Apellidos" class="form-control">
        </div>
        <div class="col-5">
            <b>Foto: </b><input type="file" name="imagen" class="form-control-file" />
        </div>
    </div>
    <div class="row m-3">
        <div class="col-5">
            <input type="text" name="email" required placeholder="Correo Electronico" class="form-control">
        </div>
        <div class="col-2">
            <input type="text" name="telefono" placeholder="Numero de Telefono" class="form-control">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success mb-3">
                <i class="fa fa-plus"></i>Registrar Alumno
            </button>
            <button type="reset" class="btn btn-warning mb-3">
                <i class="fa fa-brush"></i>Limpiar Campos
            </button>
            <a href="{{route('alumnos.index')}}" class="btn btn-primary mb-3">
                <i class="fa fa-house-user"></i>Volver
            </a>
        </div>
    </div>
</form>
@endsection
