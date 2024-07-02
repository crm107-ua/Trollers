<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Models\User;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificaciones = Notificacion::where("id_destino",Auth::user()->id)->orderBy('id','DESC')->limit(12)->get();
        $recientes = Notificacion::where("id_origen",Auth::user()->id)->orderBy('id','DESC')->limit(12)->get();
        return view('general.Notificaciones.index', compact('notificaciones','recientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::orderBy('name')->whereNotIn('id', [Auth::user()->id])->get();
        return view('general.Notificaciones.new', compact('usuarios'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notificacion = Notificacion::where("id",$id)->get();
        if($notificacion[0]->id_destino == Auth::user()->id){
            Notificacion::where("id",$id)->update(['leido' => true]);
        }
        return view('general.Notificaciones.view', compact('notificacion'));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function responder($id)
    {
        $notificacion = Notificacion::where("id_destino",Auth::user()->id)->where("id",$id)->get();
        $usuarios = User::orderBy('name')->whereNotIn('id', [Auth::user()->id])->get();
        return view('general.Notificaciones.responder', compact('notificacion','usuarios'));
    }


       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $usuarios = User::all()->whereNotIn('id', [Auth::user()->id]);
        $cabecera = htmlspecialchars(trim($request->input('cabecera')));
        $mensaje = $request->input('mensaje');
        $id_destino = $request->input('id_destino');

        try {
            if (!isset($cabecera)){throw new Exception('Faltan parametros');}
            if (!isset($mensaje)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }

        $this->vaidateImg();

        if($id_destino==0){
            foreach($usuarios as $usuario){
                if (!isset($error)) {
                    Notificacion::insert(
                        [
                            'id_origen' => Auth::user()->id,
                            'id_destino' => $usuario->id,
                            'cabecera' => $cabecera,
                            'mensaje' => $mensaje,
                            'fecha' => now(),
                            'imagen' => $_FILES["fileToUpload"]["name"],
                            'grupal' => true
                        ]);
                }
            }
        }else{
            if (!isset($error)) {
            Notificacion::insert(
                [
                    'id_origen' => Auth::user()->id,
                    'id_destino' => $id_destino,
                    'cabecera' => $cabecera,
                    'mensaje' => $mensaje,
                    'fecha' => now(),
                    'imagen' => $_FILES["fileToUpload"]["name"]
                ]);
            }
        }

        return redirect()->route('notificaciones');
    }

    /**
     * Envia un email a un usuario en concreto
     *
     * @param  $usuario
     */
    public function enviar_email($usuario, $asunto, $mensaje, $imagen) {
        $data = array('receptor'=>$usuario->name,
                      'cargo_receptor'=>$usuario->cargo,  
                      'emisor' => Auth::user()->cargo,
                      'asunto' => $asunto,
                      'mensaje' => $mensaje);
        Mail::send('general.Mail.mail', $data, function($message) use($usuario, $imagen){
           $message->to($usuario->email_personal, 'Trollers Email')->subject
              ('Nueva notificación');
            if(!empty($imagen)){
                $message->attach('http://www.trollers.es/images/fotos/'.$imagen);
            }
           $message->from('correo@trollers.es','Administracion de Trollers');
        });
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
        $target_dir = "images/fotos/";
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
        && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "mp4") {
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