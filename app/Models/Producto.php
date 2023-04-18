<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Authenticatable
{
    use SoftDeletes;
    protected $table = "producto";
    public $timestamps = false;
    protected $fillable = ['id', 'nombre', 'concentracion', 'adicional', 'precio', 'imagen', 'producto_lab', 'producto_tipo', 'producto_pre'];

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'producto_lab');
    }
    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'producto_tipo');
    }
    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class, 'producto_pre');
    }
}
