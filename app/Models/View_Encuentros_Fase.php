<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View_Encuentros_Fase extends Model
{
    use HasFactory;
    protected $table = 'view_encuentros_fase';
    public $timestamps = false; 
    protected $primaryKey = 'id_enc';
    protected $keyType = 'string';
    protected $fillable = [
        'id_enc',
        'fk_idcamp',
        'fk_idequlocal',
        'logo_local',
        'nombre_fase',
        'numgrupo',
        'goleslocal',
        'fk_idequvisit',
        'logo_visit',
        'golesvisit',
        'campo',
        'fecha_hora',
    ];
}
