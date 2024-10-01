<?php
namespace App\Http\Controllers;

use DB;
use App\Models\Image;
use App\Models\Alerta;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // API KEY: hfWSPJL12u33yaBzC2Wz6F9KUQreKLC1fe75WtLI
        // ACCOUNT ID: f5cd7a863462508bae57556e99b2c0e9
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $imagenes = Image::orderBy('id', 'DESC')->get();
        $alerta = Alerta::orderBy('id', 'DESC')->first();
        $edit = false;
        $serverStatus = $this->queryMinecraftServer('minecraft.trollers.es', 25565);
        return view('general.Home.home', compact('imagenes', 'edit', 'alerta', 'serverStatus'));
    }

    // Funcion para consultar el servidor de Minecraft
    private function queryMinecraftServer($ip, $port = 25565)
    {
        try {
            $startTime = microtime(true);

            $socket = @fsockopen($ip, $port, $errno, $errstr, 1.5);

            if (!$socket) {
                return false;
            }

            fwrite($socket, "\xFE\x01");
            $response = fread($socket, 1024);
            fclose($socket);

            $ping = round((microtime(true) - $startTime) * 1000);

            if ($response == null || substr($response, 0, 1) != "\xFF") {
                return false;
            }

            $response = substr($response, 3);
            $response = mb_convert_encoding($response, 'UTF-8', 'UCS-2');
            $data = explode("\x00", $response);

            return [
                'version' => $data[2],
                'players' => (int)$data[4],
                'maxPlayers' => (int)$data[5],
                'ping' => $ping,
                'online' => true
            ];
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function timeline()
    {
        return view('general.Timeline.timeline');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $imagenes = Image::orderBy('id', 'DESC')->get();
        $alerta = Alerta::orderBy('id', 'DESC')->first();
        $edit = true;
        return view('general.Home.home', compact('imagenes', 'edit', 'alerta'));
    }
}