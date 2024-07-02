<?php

namespace App\Http\Controllers;

use App\Models\Protocolo;
use Illuminate\Http\Request;

class ProtocoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $protocolos = Protocolo::get();
        return view('general.Protocolos.protocolos', compact('protocolos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.Protocolos.create-protocol');
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
        $descripcion = $request->input('descripcion');
        try {
            if (!isset($titulo)){throw new Exception('Faltan parametros');}
            if (!isset($descripcion)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }
        if (!isset($error)) {
            Protocolo::insert(
                [
                    'usuario' => $request->usuario,
                    'fecha' => date("d/m/Y"),
                    'titulo' => $titulo,
                    'descripcion' => $descripcion
                ]);
        }
        return redirect()->route('protocolos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocolo = Protocolo::find($id);
        return view('general.Protocolos.form-protocol', compact('protocolo'));
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
            Protocolo::where('id', $request->input('id'))->update(
                [
                    'titulo' => $titulo,
                    'descripcion' => $descripcion
                ]);
        }
        return redirect()->route('protocolos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Protocolo::where('id', $request->input('id'))->delete();
        return redirect()->route('protocolos');
    }
}