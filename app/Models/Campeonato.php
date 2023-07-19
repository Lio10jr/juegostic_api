<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;
    protected $table = 'campeonato';
    public $timestamps = false; 
    protected $primaryKey = 'pk_idcamp';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'pk_idcamp',
        'name_camp',
        'logo',
        'semestre',
        'anio_camp',
        'estado'
    ];
}
