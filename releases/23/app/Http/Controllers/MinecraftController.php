<?php

namespace App\Http\Controllers;

use App\Models\Minecraft;
use Illuminate\Http\Request;

class MinecraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Minecraft::orderBy('id','DESC')->get();
        return view('general.Terminal.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.Terminal.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = htmlspecialchars(trim($request->input('name')));
        $descripcion = htmlspecialchars(trim($request->input('descripcion')));
        $link = htmlspecialchars(trim($request->input('link')));
        try {
            if (!isset($name)){throw new Exception('Faltan parametros');}
            if (!isset($descripcion)){throw new Exception('Faltan parametros');}
            if (!isset($link)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }

        if (!isset($error)) {
            Minecraft::insert(
                [
                    'name' => $name,
                    'descripcion' => $descripcion,
                    'link' => $link
                ]);
        }
        return redirect()->route('minecraft');
    }
}