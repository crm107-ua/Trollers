<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    protected $fillable = [
        'id',
        'titulo',
        'descripcion',
        'fecha',
        'finalDate',
        'tipo',
        'persona',
        'image'
    ];
}