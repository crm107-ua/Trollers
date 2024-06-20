<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Minijuego;
use Illuminate\Http\Request;

class MinijuegoController extends Controller
{
    /**
     * Display game resources.
     */
    public function index()
    {
        $citas = Minijuego::select('id', 'name')->inRandomOrder()->get();
        $users = User::all();
        return view('general.Minijuego.index', compact('citas', 'users'));
    }

}