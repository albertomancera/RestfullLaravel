<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemon'; 

    protected $fillable = [
        'nombre', 
        'tipo', 
        'nivel', 
        'es_legendario', 
        'peso', 
        'fecha_captura'
    ];
}