<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    /**
     * Mostrar la página del stream con el estado actual.
     */
    public function index()
    {
        $stream = Stream::first();
        return view('general.Stream.index', ['is_active' => $stream->is_active]);
    }

    /**
     * Mostrar la página del visor con el stream actual.
     */
    public function show()
    {
        return view('general.Stream.view');
    }

    /**
     * Iniciar el stream, cambiar el estado a activo y ejecutar FFmpeg.
     */
    public function startStream() {
        // Cambiar el estado del stream a activo
        $stream = Stream::first();
        $stream->is_active = true;
        $stream->save();

        // Ejecutar FFmpeg para convertir el stream a RTMP
        exec('ffmpeg -re -i /tmp/stream-video.webm -c:v libx264 -preset fast -f hls -hls_time 10 -hls_list_size 0 -f hls /var/www/html/stream/hls/stream.m3u8 > /dev/null 2>/dev/null &');

        return redirect()->route('tv');
    }

    /**
     * Detener el stream, cambiar el estado a inactivo y matar el proceso de FFmpeg.
     */
    public function endStream() {
        // Cambiar el estado del stream a inactivo
        $stream = Stream::first();
        $stream->is_active = false;
        $stream->save();

        // Matar el proceso de FFmpeg para detener el stream
        exec('pkill -f ffmpeg');

        return redirect()->route('tv');
    }
}