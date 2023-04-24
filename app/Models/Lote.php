<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lote extends Model
{
    use SoftDeletes;
    protected $table = "lote";
    public $timestamps = false;
    protected $fillable = ['id', 'stock', 'vencimiento', 'lote_id_prod', 'lote_id_prov'];
    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'lote_id_prod');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'lote_id_prov');
    }
    
}