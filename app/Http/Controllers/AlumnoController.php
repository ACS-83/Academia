<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::orderBy('nombre')->paginate(5);
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => ['required', 'unique:alumnos,email'],
            'telefono' => ['nullable'],
        ]);

        $alumno = new Alumno();
        $alumno->nombre = ucwords($request->nombre);
        $alumno->apellidos = ucwords($request->apellidos);
        $alumno->email = $request->email;
        $alumno->telefono = $request->telefono;
        if ($request->has('imagen')) {
            $request->validate([
                'imagen' => ['image']
            ]);
            $fileImagen = $request->file('imagen');
            $nombreImagen = "img/alumnos/" . uniqid() . "_" . $fileImagen->getClientOriginalName();
            Storage::Disk("public")->put($nombreImagen, \File::get($fileImagen));
            $alumno->imagen = "storage/" . $nombreImagen;
        }
        $alumno->save();
        return redirect()->route('alumnos.index')->with('mensaje', "Alumno Registrado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => ['required'],
            'telefono' => ['nullable'],
        ]);

        $alumno->update([
            'nombre' => ucwords($request->nombre),
            'apellidos' => ucwords($request->apellidos),
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        if ($request->has('imagen')) {

            $request->validate([
                'imagen' => ['image']
            ]);
            $fileImagen = $request->file('imagen');

            $nombreImagen = "img/alumnos/" . uniqid() . "_" . $fileImagen->getClientOriginalName();
            if (basename($alumno->imagen) != 'default.png') {
                unlink($alumno->imagen);
            }
            Storage::Disk("public")->put($nombreImagen, \File::get($fileImagen));
            $alumno->update([
                'imagen' => "storage/" . $nombreImagen
            ]);
        }
        return redirect()->route('alumnos.index')->with('mensaje', "Registro Actualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        $fotoAlumno = basename($alumno->imagen);
        if ($fotoAlumno != 'default.png') {
            unlink($alumno->imagen);
        }
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('mensaje', "Alumno eliminado correctamente");
    }
}
