<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase_Encuentros extends Model
{
    use HasFactory;
    protected $table = 'fase_encuentros';
    public $timestamps = false; 
    protected $primaryKey = 'id_fase_e';
    public $incrementing = false;

    protected $fillable = [
        'id_fase_e',
        'nombre_fase'
    ];
}
