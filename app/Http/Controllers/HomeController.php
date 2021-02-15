<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Country;
use App\Models\Employed;
use App\Models\StaticData;
use App\Models\Todolist;
use App\Models\User;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

    public function getExpenseType()
    {
        $ps = StaticData::where('type', 'Type de dépense')->get();

        return response()->json($ps);
    }

    public function getPaymentsMode()
    {
        $ps = StaticData::where('type', 'Mode de paiement')->get();

        return response()->json($ps);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['message' => "Ajout utilisateur avec succès"]);
    }

    public function logout()
    {
        Auth::logout();
    }
}
