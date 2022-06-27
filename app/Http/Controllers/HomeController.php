<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Products;
use Illuminate\Http\Request;

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
        $data['popularProducts'] = Products::orderBy('views', 'desc')->take(4)->get();
        $data['newProducts'] = Products::orderBy('id', 'desc')->take(4)->get();
        $data['images'] = Images::all();
        return view('Home', $data);
    }
}
