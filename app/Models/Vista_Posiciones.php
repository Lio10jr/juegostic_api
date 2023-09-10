<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vista_Posiciones extends Model
{
    protected $table = 'vista_posiciones'; // Nombre de la vista en la base de datos
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
        'PJ',
        'PG',
        'PE',
        'PP',
        'GF',
        'GC',
        'GD',
        'Pts',
    ];
}
