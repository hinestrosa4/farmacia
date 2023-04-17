<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentacion extends Model
{
    use SoftDeletes;
    protected $table = "presentacion";
    public $timestamps = false;
    protected $fillable = ['id', 'nombre'];
}
