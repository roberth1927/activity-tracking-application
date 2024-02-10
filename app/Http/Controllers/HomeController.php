<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividade;


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
        $userId = auth()->user()->id;

        $totalActividades = Actividade::where('user_id', $userId)->count();

        $totalPendientes = Actividade::where('user_id', $userId)->where('estado', 0)->count();

        $totalCompletadas = Actividade::where('user_id', $userId)->where('estado', 1)->count();

        return view('home', [
            'totalActividades' => $totalActividades,
            'totalPendientes' => $totalPendientes,
            'totalCompletadas' => $totalCompletadas,
        ]);
    }


}
