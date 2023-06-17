<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DB;
use Hash;
use Exception;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function create(Request $request)
    {
        $name = htmlspecialchars(trim($request->input('name')));
        $email = htmlspecialchars(trim($request->input('email')));
        $password = htmlspecialchars(trim($request->input('password')));
        try {
            if (empty($email)){throw new Exception('Email vacio');}
            if (empty($name)){throw new Exception('Nombre vacio');}
            if (empty($password)){throw new Exception('Contraseña vacia');}
            if (strlen($password) < 6){throw new Exception('Longitud minima de contraseña 6 carácteres');}
        } catch (\Exception $e) {
            $error = ($e->getMessage());
        }
        if(!$this->vaidateImg()){
            $error = "La imagen no es apta";
        }
        if (!isset($error)) {
            User::insert(
                [
                    'name' => $name, 
                    'email' => $email,
                    'password' => Hash::make($password),
                    'imagen' => $_FILES["fileToUpload"]["name"]
                ]
            );
            $error = "Usuario registrado correctamente";
        }
        return view("usuario.registro.registro",compact('error'));
    }

    protected function vaidateImg(){
        $target_dir = "images/perfiles/";
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
