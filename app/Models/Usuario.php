<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use SoftDeletes;
    protected $table = "usuario";
    public $timestamps = false;
    protected $fillable = ['id', 'email', 'nombre', 'apellidos', 'edad', 'dni', 'telefono', 'direccion', 'sexo', 'password', 'tipo'];
}
