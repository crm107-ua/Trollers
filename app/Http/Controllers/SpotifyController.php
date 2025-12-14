<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI;

class SpotifyController extends Controller
{

    public function index()
    {
        $session = new SpotifyWebAPI\Session(
            env('SPOTIFY_KEY'),
            env('SPOTIFY_SECRET'),
            env('SPOTIFY_REDIRECT_URI')
        );

        $options = [
            'scope' => [
                'user-read-email',
                'user-top-read',
                'user-read-recently-played',
                'user-follow-read',
                'user-read-private',
            ],
        ];

        header('Location: ' . $session->getAuthorizeUrl($options));
        die();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $api = new SpotifyWebAPI\SpotifyWebAPI();

        $session = new SpotifyWebAPI\Session(
            env('SPOTIFY_KEY'),
            env('SPOTIFY_SECRET'),
            env('SPOTIFY_REDIRECT_URI')
        );

        $session->requestAccessToken($_GET["code"]);
        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();
        $api->setAccessToken($accessToken);

        $usuario = $api->me();
        $temas = $api->getMyTop('tracks')->items;
        $artistas = $api->getMyTop('artists')->items;
        return view('general.Cuenta.music', compact('usuario','temas','artistas'));

    }

    public function getHitsTrollers()
    {
        return view('general.HitsTrollers.index');
    }

}