<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;
    protected $table = "proveedor";
    public $timestamps = false;
    protected $fillable = ['id', 'nombre', 'telefono', 'email', 'direccion'];
}
