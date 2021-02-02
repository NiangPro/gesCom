<?php

namespace App\Http\Controllers;

use App\Models\StaticData;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getTaxe()
    {
        $taxes = StaticData::where('type', 'taxe')->get();

        return response()->json($taxes);
    }

    public function getProductType()
    {
        $productType = StaticData::where('type', 'type de produit')->get();

        return response()->json($productType);
    }
}
