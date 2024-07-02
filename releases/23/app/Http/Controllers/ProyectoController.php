<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.Proyectos.agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titulo = htmlspecialchars(trim($request->input('titulo')));
        $lugar = htmlspecialchars(trim($request->input('lugar')));
        $descripcion = htmlspecialchars(trim($request->input('descripcion')));
        $nivel = htmlspecialchars(trim($request->input('nivel')));
        try {
            if (!isset($titulo)){throw new Exception('Faltan parametros');}
            if (!isset($lugar)){throw new Exception('Faltan parametros');}
            if (!isset($descripcion)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }
        if (!isset($error)) {
            Proyecto::insert(
                [
                    'titulo' => $titulo,
                    'lugar' => $lugar,
                    'descripcion' => $descripcion,
                    'nivel' => $nivel
                ]
            );
        }
        return redirect()->route('proyectos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $proyectos = Proyecto::all();
        return view('general.Proyectos.proyectos', compact('proyectos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('general.Proyectos.agregar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Proyecto::where('id', $request->input('id'))->delete();
        return redirect()->route('proyectos');
    }
}