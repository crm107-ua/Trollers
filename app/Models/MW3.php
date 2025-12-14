<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MW3 extends Model
{
    protected $table = 'mw3';

    protected $fillable = [
        'name',
        'ronda',
        'puntos',
        'tiempo',
        'code',
        'fecha',
        'mapa',
        'image',
        'mode'
    ];
}