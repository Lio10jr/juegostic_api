<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuentros extends Model
{
    protected $table = 'encuentros';
    public $timestamps = false; 
    protected $primaryKey = 'id_enc';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_enc',
        'fk_idcamp',
        'fk_idequlocal',
        'fk_id_fase_e',
        'goleslocal',
        'fk_idequvisit',
        'golesvisit',
        'campo',
        'fecha_hora'
    ];
}
