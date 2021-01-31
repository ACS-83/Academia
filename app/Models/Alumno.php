<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    //Creamos un array con los campos que queramos poder cambiar
    protected $fillable=['nombre', 'apellidos', 'email', 'imagen', 'telefono'];
}
