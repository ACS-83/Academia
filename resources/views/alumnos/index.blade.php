@extends('plantillas.plantilla1')
@section('titulo')
    Alumnos
@endsection
@section('cabecera')
    Alumnos academia
@endsection
@section('contenido')
    @if ($text = Session::get('mensaje'))
        <p class="bg-secondary text-white p-2 my-3">{{ $text }}</p>
    @endif
    <a href="{{ route('alumnos.create') }}" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i>Crear alumno
    </a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Mail</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $item)
                <tr>
                    <th scope="row"><img src="{{ asset($item->imagen) }}" width="50rem" height="50rem"
                            class="rounded-circle"></th>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->apellidos }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>
                        <form action="{{ route('alumnos.destroy', $item) }}" method="post" class="form-inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('alumnos.edit', $item) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>Modificar
                            </a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que quieres borrar?')">
                                <i class="fa fa-trash"></i> Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $alumnos->links() }}
@endsection
