<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Auth;
use DateTime;
use App\Models\User;
use App\Models\Calendar;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $table = 'users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.Cuenta.cuenta');
    }

    /**
     * Display calendar.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        $fechas = Calendar::all();
        return view('general.Calendar.index', compact('fechas'));
    }

    /**
     * Display covid certificate.
     *
     * @return \Illuminate\Http\Response
     */
    public function certificado()
    {
        return view('general.usuarios.certificado');
    }

    /**
     * Display add event view.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEvent()
    {
        return view('general.Calendar.addEvent');
    }

    /**
     * Delete an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteEvent(Request $request)
    {
        Calendar::where('id', $request->input('id'))->delete();
        return redirect()->route('calendar');
    }

    /**
     * Delete an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDeleteEvent()
    {
        $fechas = Calendar::all();
        return view('general.Calendar.delEvent',compact('fechas'));
    }

    /**
     * Add an event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createEvent(Request $request)
    {
        $titulo = htmlspecialchars(trim($request->input('titulo')));
        $descripcion = $request->input('descripcion');
        $inputDate = htmlspecialchars(trim($request->input('inputDate')));
        $finalDate = htmlspecialchars(trim($request->input('finalDate')));
        $tipo = htmlspecialchars(trim($request->input('tipo')));

        try {
            if (!isset($titulo)){throw new Exception('Faltan parametros');}
            if (!isset($descripcion)){throw new Exception('Faltan parametros');}
            if (!isset($inputDate)){throw new Exception('Faltan parametros');}
            if (!isset($finalDate)){throw new Exception('Faltan parametros');}
            if (!isset($tipo)){throw new Exception('Faltan parametros');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }

        $this->vaidateImg();

        if (!isset($error)) {
            Calendar::insert(
                [
                    'titulo' => $titulo,
                    'descripcion' => "{{".$descripcion."}}",
                    'fecha' => new DateTime($inputDate),
                    'finalDate' => new DateTime($finalDate),
                    'tipo' => $tipo,
                    'persona' => Auth::user()->id,
                    'image' => $_FILES["fileToUpload"]["name"]
                ]);
        }
        return redirect()->route('calendar');
    }



    /**
     * Return a single object user
     *
     * @return \Illuminate\Http\Response
     */
    static function getUser($id)
    {
        return User::where('id', $id)->get()->first();
    }


    /**
     * Return a single object user by email
     *
     * @return \Illuminate\Http\Response
     */
    static function getUserByEmail($email)
    {
        return User::where('email', $email)->get()->first();
    }

     /**
     * Reser password by email
     *
     * @return \Illuminate\Http\Response
     */
    static function resetPassword($email,$pass)
    {
        User::where('email', $email)->update(['password' => Hash::make($pass)]);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuarios = User::orderBy('id')->get();
        return view('general.Formacion.formacion', compact('usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('general.Cuenta.editar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $texto = $request->input('texto');
        try {
            if (strlen($texto) > 4000){throw new Exception('Descripcion maxima de 4000 caracteres');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }
        if (!isset($error)) {
            User::where('id', $request->input('id'))->update(
                [
                    'descripcion' => $texto,
                ]
            );
        }
        return view('general.Cuenta.cuenta');
    }

    public function passEdit()
    {
        return view('general.Cuenta.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function passUpdate(Request $request)
    {
        $password = htmlspecialchars(trim($request->input('password')));
        try {
            if (strlen($password) < 4){throw new Exception('Longitud minima de 4 caracteres');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }
        if (!isset($error)) {
            User::where('id', $request->input('id'))->update(
                [
                    'password' => Hash::make($password),
                ]
            );
        }
        return view('general.Cuenta.cuenta');
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