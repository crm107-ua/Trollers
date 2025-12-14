<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'texto',
        'nivel',
        'alternative'
    ];
}