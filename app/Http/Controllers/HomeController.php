<?php
namespace App\Http\Controllers;

use DB;
use App\Models\Image;
use App\Models\Alerta;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


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
        $serverStatus = $this->queryMinecraftServer('minecraft.trollers.es', 25593);
        $isLive = $this->isStreamLive();

        return view('general.Home.home', compact('imagenes', 'edit', 'alerta', 'serverStatus', 'isLive'));
    }

    private function getMarketPrices(): array
    {
        $response = Http::get('https://api2.warera.io/trpc/itemTrading.getPrices');

        if (!$response->successful()) {
            return [];
        }

        $json = $response->json();

        return $json['result']['data'] ?? [];
    }

    private function getRecommendations(array $prices, float $buyThreshold = 0.1, float $sellThreshold = 5.0): array
    {
        $toBuy = [];
        $toSell = [];

        foreach ($prices as $item => $price) {
            if ($price < $buyThreshold) {
                $toBuy[$item] = $price;
            } elseif ($price > $sellThreshold) {
                $toSell[$item] = $price;
            }
        }

        return [$toBuy, $toSell];
    }

    /**
     * Check if the stream is live.
     *
     * @return bool
     */
    private function isStreamLive()
    {
        return Cache::remember('stream_status', 5, function () {
            $response = Http::get('https://tv.trollers.es/api/status');
            return $response->successful() ? $response->json()['online'] : false;
        });
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
        $serverStatus = $this->queryMinecraftServer('minecraft.trollers.es', 25565);
        $isLive = $this->isStreamLive();
        return view('general.Home.home', compact('imagenes', 'edit', 'alerta', 'serverStatus', 'isLive'));
    }
}
