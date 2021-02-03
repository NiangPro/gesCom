<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Country;
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
        $taxes = StaticData::where('type', 'TVA')->get();

        return response()->json($taxes);
    }

    public function getProductType()
    {
        $productType = StaticData::where('type', 'Type des produits et services')->get();

        return response()->json($productType);
    }


    public function getTaskStatus()
    {
        $taskStatus = StaticData::where('type', 'Statut de la tâche')->get();

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

    public function getCountry()
    {
        $pays = Country::orderBy('nom_fr', 'ASC')->get();

        return response()->json($pays);
    }

    public function getProspectSource()
    {
        $ps = StaticData::where('type', 'Source du prospect')->get();

        return response()->json($ps);
    }
}
