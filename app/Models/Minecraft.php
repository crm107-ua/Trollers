<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Minecraft extends Model
{
    protected $table = 'minecraft';

    protected $fillable = [
        'id',
        'name',
        'descripcion',
        'alternative'
    ];
}