<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    /**
     * Mostrar la página del visor con el stream actual.
     */
    public function index()
    {
        return view('general.Stream.index');
    }
}