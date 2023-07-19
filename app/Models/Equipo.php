<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $table = 'equipos';
    public $timestamps = false; 
    protected $primaryKey = 'pk_idequ';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'pk_idequ',
        'nom_equ',
        'logo',
        'semestre',
        'representante',
        'fk_idcamp'
    ];
}
