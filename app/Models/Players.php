<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    protected $table = 'players';
    public $timestamps = false; 
    protected $primaryKey = 'pk_ced';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'pk_ced',
        'nombre',
        'apellido',
        'semestre',
        'f_nacimiento',
        'fk_idequ'
    ];
}
