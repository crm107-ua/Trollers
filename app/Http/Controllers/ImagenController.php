<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;

class ImagenController extends Controller
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
        return view('general.Home.imagenes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->vaidateImg(true)){
            $error = "La imagen no es apta";
        }
        if (!isset($error)) {
            Image::insert(
                [
                    'name' => $_FILES["fileToUpload"]["name"],
                ]
            );
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
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('general.Cuenta.editImage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$this->vaidateImg(false)){
            $error = "La imagen no es apta";
        }
        if (!isset($error)) {
            User::where('id', $request->input('id'))->update(['imagen' => $_FILES["fileToUpload"]["name"]]);
        }
        return view('general.Cuenta.cuenta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Image::where('id', $request->input('id'))->delete();
        return redirect()->route('home');
    }

    //VALIDA FOTOS Y LAS GUARDA EN CARPETA
    protected function vaidateImg($type){
        if($type){
            $target_dir = "images/fotos/";
        }else{
            $target_dir = "images/perfiles/";
        }

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