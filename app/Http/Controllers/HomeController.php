<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employed;
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
        $productType = StaticData::where('type', 'product type')->get();

        return response()->json($productType);
    }

    public function getTaskType()
    {
        $taskType = StaticData::where('type', 'task type')->get();

        return response()->json($taskType);
    }

    public function getTaskStatus()
    {
        $taskStatus = StaticData::where('type', 'task status')->get();

        return response()->json($taskStatus);
    }

    public function getEmployeds()
    {
        $emp = Employed::orderBy('prenom', 'ASC')->get();

        return response()->json($emp);
    }

    public function getClients()
    {
        $clients = Client::orderBy('nom', 'ASC')->get();

        return response()->json($clients);
    }
}
