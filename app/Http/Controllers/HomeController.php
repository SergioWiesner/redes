<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\mensajes;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allUsers = User::where('id', '<>', Auth::user()->id)->get()->toArray();
        return view('home')
            ->with("usuarios", $allUsers);
    }

    public function obtenerMensajes(Request $id)
    {
        $allUsers = User::where('id', '<>', Auth::user()->id)->get()->toArray();
        $mensajesporusuario = mensajes::where([['receptor', "=", $id['idUsuario']], ["emisor", "=", Auth::user()->id]])->orWhere([['receptor', "=", Auth::user()->id], ["emisor", "=", $id['idUsuario']]])->with('emisor')->with('receptor')->get()->toArray();
        return view('home')
            ->with('idusuario', $id['idUsuario'])
            ->with("usuarios", $allUsers)
            ->with("mensajes", $mensajesporusuario);
    }
}
