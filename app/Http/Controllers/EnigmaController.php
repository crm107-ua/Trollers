<?php

namespace App\Http\Controllers;

use App\Models\Enigma;
use Illuminate\Http\Request;

class EnigmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.Enigma.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function code(Request $request)
    {
        $input = $request->input('code');
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';
        $decryption_iv = '1234567891011121';
        $resultado="";

        $llave = $request->input('digito1').$request->input('digito2').$request->input('digito3').$request->input('digito4');

        if(!$request->input('mode')){
            try {
                $resultado = str_replace("=","",openssl_encrypt($input, $ciphering,$llave, $options, $encryption_iv));
                Enigma::insert(
                    [
                        'code' => $resultado,
                        'pass' => $llave,
                        'fecha' => now()
                    ]);
            } catch (\Throwable $th) {
                $resultado="Combinación incorrecta";
                return view('general.Enigma.index',compact('resultado'));
            }
        }else{
            try {
                $resultado=openssl_decrypt ($input, $ciphering,$llave, $options, $decryption_iv);
            } catch (\Throwable $th) {
                $resultado="Combinación incorrecta";
                return view('general.Enigma.index',compact('resultado'));
            }
        }

        return view('general.Enigma.index', compact('resultado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function decode(Request $request)
    {
        $input = $request->input('decode');

        $decode = base64_decode($input);
            list($decode, $letra) = explode('+', $decode);
            $arrayLetras = explode("/",date("d/m"));
            //$arrayLetras = ["A","B","F"];
            for ($i = 0; $i < count($arrayLetras); $i++) {
                if ($arrayLetras[$i] == $letra) {
                    for ($j = 1; $j <= $i; $j++) {
                        $decode = base64_decode($decode);
                    }
                    break;
                }
            }

        return view('general.Enigma.index', compact('decode'));
    }

    /**
     * Weed manager tool.
     *
     * @return \Illuminate\Http\Response
     */
    public function manager()
    {
        return view('general.Manager.index');
    }


    /**
     * Weed manager tool.
     *
     * @return \Illuminate\Http\Response
     */
    public function manager_create(Request $request)
    {
        $cantidad = $request->input('cantidad');
        $miembros = $request->input('miembros');
        $aportaciones = $request->input('aportaciones');
        $aportacionTotal = 0;
        $tablaInicial=[];
        $tablaResultados=[];
        $grafica=[];

        foreach($aportaciones as $aportacion){
            $aportacionTotal+=$aportacion;
        }

        foreach($miembros as $key => $miembro){
            $tablaInicial += array($miembro => $aportaciones[$key]);
        }

        foreach($tablaInicial as $miembro => $aportacion){
            $tablaResultados += array(ucfirst($miembro) => ($aportacion*$cantidad)/$aportacionTotal);
        }

        foreach($tablaResultados as $miembro => $gramos){
            $grafica += array(ucfirst($miembro) => ($gramos*100)/$cantidad);
        }

        return view('general.Manager.results', compact('tablaResultados','grafica'));
    }

}
