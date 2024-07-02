<?php

namespace App\Http\Controllers;

use App\Models\BOE;
use Illuminate\Http\Request;

class BOEcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = BOE::orderBy('id','DESC')->get();
        return view('general.BOE.boe', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.BOE.create-boe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ministerio = htmlspecialchars(trim($request->input('ministerio')));
        $titulo = htmlspecialchars(trim($request->input('titulo')));
        $descripcion = $request->input('descripcion');
        try {
            if (!isset($titulo)){throw new Exception('Faltan parametros');}
            if (!isset($descripcion)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }
        if (!isset($error)) {
            BOE::insert(
                [
                    'ministerio' => $ministerio,
                    'fecha' => date("d/m/Y"),
                    'titulo' => $titulo,
                    'descripcion' => $descripcion
                ]);
        }
        return redirect()->route('boe');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = BOE::find($id);
        return view('general.BOE.form-boe', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $titulo = htmlspecialchars(trim($request->input('titulo')));
        $descripcion = $request->input('descripcion');
        try {
            if (!isset($titulo)){throw new Exception('Faltan parametros');}
            if (!isset($descripcion)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }
        if (!isset($error)) {
            BOE::where('id', $request->input('id'))->update(
                [
                    'titulo' => $titulo,
                    'descripcion' => $descripcion
                ]);
        }
        return redirect()->route('boe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        BOE::where('id', $request->input('id'))->delete();
        return redirect()->route('boe');
    }
}