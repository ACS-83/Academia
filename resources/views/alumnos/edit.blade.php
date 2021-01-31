@extends('plantillas.plantilla1')
@section('titulo')
    Editar alumno
@endsection
@section('cabecera')
    Actualizar datos alumno
@endsection
@section('contenido')
    @if ($errors->any())
        <div class="alert alert-danger my-3 p-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('alumnos.update', $alumno) }}" name="formulario" method="post" enctype="multipart/form-data"
        class="mt-3">
        @csrf
        @method('PUT')
        <div class="row m-3">
            <div class="col-2">
                <input type="text" name="nombre" required value="{{ $alumno->nombre }}" class="form-control">
            </div>
            <div class="col-5">
                <input type="text" name="apellidos" value="{{ $alumno->apellidos }}" class="form-control">
            </div>
            <div class="col-5">
                <b>Foto: </b><input type="file" name="imagen" class="form-control-file" />
            </div>
        </div>
        <div class="row m-3">
            <div class="col-5">
                <input type="text" name="email" required value="{{ $alumno->email }}" class="form-control">
            </div>
            <div class="col-2">
                <input type="text" name="telefono" value="{{ $alumno->telefono }}" class="form-control">
            </div>
            <div class="col-5">
                <img src="{{ asset($alumno->imagen) }}" class="img-thumbnail" width="80px" height="80px" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success mb-3">
                    <i class="fa fa-edit"></i>Modificar alumno
                </button>
                <a href="{{ route('alumnos.index') }}" class="btn btn-primary mb-3">
                    <i class="fa fa-house-user"></i>Volver
                </a>
            </div>
        </div>
    </form>
@endsection
