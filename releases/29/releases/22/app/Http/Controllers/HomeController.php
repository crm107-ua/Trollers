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
        return view('general.Home.home', compact('imagenes', 'edit', 'alerta'));
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
