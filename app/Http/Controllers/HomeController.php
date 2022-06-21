<?php

namespace App\Http\Controllers;

use App\Models\images;
use App\Models\products;
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
        $data['popularProducts'] = products::orderBy('views', 'desc')->take(2)->get();
        $data['newProducts'] = products::orderBy('id', 'desc')->take(2)->get();
        $data['images'] = images::all();
        return view('Home', $data);
    }
}
