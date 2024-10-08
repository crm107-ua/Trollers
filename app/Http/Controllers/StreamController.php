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
     * Iniciar el stream, cambiar el estado a activo y ejecutar FFmpeg.
     */
    public function startStream() {
        // Cambiar el estado del stream a activo
        $stream = Stream::first();
        $stream->is_active = true;
        $stream->save();

        // Ejecutar FFmpeg para convertir el stream a RTMP
        exec('ffmpeg -re -i /tmp/stream-video.webm -c:v libx264 -preset fast -f flv rtmp://192.168.50.20/live/stream > /dev/null 2>/dev/null &');

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