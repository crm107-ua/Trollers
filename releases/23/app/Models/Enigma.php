<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Enigma extends Model
{
    protected $table = 'enigma';

    protected $fillable = [
        'id',
        'code',
        'pass',
        'fecha'
    ];
}