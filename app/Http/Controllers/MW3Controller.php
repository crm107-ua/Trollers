<?php

namespace App\Http\Controllers;

use App\Models\MW3;
use Illuminate\Http\Request;

class MW3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $individual = MW3::where("mode",0)->orderBy('puntos','DESC')->get();
        $parejas = MW3::where("mode",1)->orderBy('puntos','DESC')->get();
        return view('general.MW3.mw3', compact('individual','parejas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.MW3.create-mw3');
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
        $mapa = htmlspecialchars(trim($request->input('mapa')));
        $ronda = htmlspecialchars(trim($request->input('ronda')));
        $puntos = htmlspecialchars(trim($request->input('puntos')));
        $tiempo = htmlspecialchars(trim($request->input('tiempo')));
        $mode = htmlspecialchars(trim($request->input('mode')));
        try {
            if (!isset($name)){throw new Exception('Faltan parametros');}
            if (!isset($mapa)){throw new Exception('Faltan parametros');}
            if (!isset($ronda)){throw new Exception('Faltan parametros');}
            if (!isset($puntos)){throw new Exception('Faltan parametros');}
            if (!isset($tiempo)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }

        if(!$this->vaidateImg(true)){
            $error = "La imagen no es apta";
        }

        if (!isset($error)) {
            MW3::insert(
                [
                    'name' => $name,
                    'mapa' => $mapa,
                    'ronda' => $ronda,
                    'puntos' => $puntos,
                    'tiempo' => $tiempo,
                    'code' => rand(456789, 999999),
                    'fecha' => now(),
                    'image' => $_FILES["fileToUpload"]["name"],
                    'mode' => $mode
                ]);
        }
        return redirect()->route('mw3');
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
    public function edit($id)
    {
        //
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

    //VALIDA FOTOS Y LAS GUARDA EN CARPETA
    protected function vaidateImg(){
        $target_dir = "images/mw3/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        if (empty($_FILES["fileToUpload"]["tmp_name"])) {
            $uploadOk = 0;
        }else{
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
    
        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            return true;
        }else{
            return false;
        }
    }
}