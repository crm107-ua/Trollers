<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_origen',
        'id_destino',
        'leido',
        'cabecera',
        'mensaje',
        'imagen',
        'fecha',
        'grupal',
        'alternativo'
    ];
}