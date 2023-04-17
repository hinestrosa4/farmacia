<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratorio extends Model
{
    use SoftDeletes;
    protected $table = "laboratorio";    
    public $timestamps = false;
    protected $fillable = ['id', 'nombre'];
}
