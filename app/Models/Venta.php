<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;
    protected $table = "venta";
    public $timestamps = false;
    protected $fillable = ['id', 'fecha', 'cliente', 'metodoPago', 'total', 'productos', 'vendedor'];
}
