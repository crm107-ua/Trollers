<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class ControllerAlertas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alerta = Alerta::orderBy('id', 'DESC')->first();
        return view('general.Cuenta.editar-alerta', compact('alerta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $texto = $request->input('texto');
        $nivel = $request->input('nivel');
        try {
            if (!isset($texto)){throw new Exception('Faltan parametros');}
            if (!isset($nivel)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }

        if (!isset($error)) {
            Alerta::insert(
                [
                    'texto' => $texto,
                    'nivel' => $nivel,
                    'alternative' => 1,
                ]);
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        Alerta::orderBy('id', 'DESC')->first()->update(
            [
                'alternative' => $request->input('alternative'),
            ]);
        return redirect()->route('alerta');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}