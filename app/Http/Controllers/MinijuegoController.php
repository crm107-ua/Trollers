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
        $citas = Minijuego::inRandomOrder()->get();
        $users = User::select('id', 'name')->where('id', '!=', 1000)->get();
        return view('general.Minijuego.index', compact('citas', 'users'));
    }

}