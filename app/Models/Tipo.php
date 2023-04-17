<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use SoftDeletes;
    protected $table = "tipo_producto";   
    public $timestamps = false;
    protected $fillable = ['id', 'nombre']; 
}
