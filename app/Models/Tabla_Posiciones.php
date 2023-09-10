<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabla_Posiciones extends Model
{
    protected $table = 'tabla_posiciones';
    public $timestamps = false; 
    protected $primaryKey = 'id_posicion';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_posicion',
        'fk_idcamp',
        'fk_id_fase_e',
        'fk_idequ',
        'numgrupo',
        'pj',
        'pg',
        'pe',
        'pp',
        'gf',
        'gc',
        'gd',
        'pts',
    ];
}
