<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Country;
use App\Models\Employed;
use App\Models\Expense;
use App\Models\Todolist;
use App\Models\StaticData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

    public function getDevisStatus()
    {
        $ps = StaticData::where('type', 'Statut des devis')->get();

        return response()->json($ps);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function sumSale()
    {
        $ventes = Vente::select(DB::raw('distinct Sum(total_amount) as somme, Month(date) as mois'))
            ->groupBy(DB::raw("Month(date)"))->orderBy(DB::raw("MONTH(date)"), "ASC")->get();

        $som = 0;

        $moisActuel = intval(date('m'));

        foreach ($ventes as $vente) {
            if ($moisActuel === $vente->mois) {
                $som = $vente->somme;
                break;
            }
        }
        return response()->json($som);
    }

    public function sumExpense()
    {
        $expenses = Expense::select(DB::raw('distinct Sum(montant) as somme, Month(date) as mois'))
            ->groupBy(DB::raw("Month(date)"))->orderBy(DB::raw("MONTH(date)"), "ASC")->get();

        $som = 0;

        $moisActuel = intval(date('m'));

        foreach ($expenses as $exp) {
            if ($moisActuel === $exp->mois) {
                $som = $exp->somme;
                break;
            }
        }
        return response()->json($som);
    }

    public function saleByMonth()
    {
        $ventes = Vente::select(DB::raw('distinct Sum(total_amount) as somme, Month(date) as mois'))
            ->groupBy(DB::raw("Month(date)"))->orderBy(DB::raw("MONTH(date)"), "ASC")->get();


        $data = [];


        $moisActuel = intval(date('m'));

        for ($i = 1; $i <= $moisActuel; $i++) {
            $som = 0;
            foreach ($ventes as $vente) {
                if ($i === $vente->mois) {
                    $som = $vente->somme;
                    break;
                }
            }
            $data[] = $som;
        }

        // for ($i = 12 - $moisActuel; $i <= 12; $i++) {
        //     $data[] = 0;
        // }

        return response()->json($data);
    }

    public function expenseByMonth()
    {
        $expenses = Expense::select(DB::raw('distinct Sum(montant) as somme, Month(date) as mois'))
            ->groupBy(DB::raw("Month(date)"))->orderBy(DB::raw("MONTH(date)"), "ASC")->get();

        $data = [];


        $moisActuel = intval(date('m'));

        for ($i = 1; $i <= $moisActuel; $i++) {
            $som = 0;
            foreach ($expenses as $exp) {
                if ($i === $exp->mois) {
                    $som = $exp->somme;
                    break;
                }
            }
            $data[] = $som;
        }

        return response()->json($data);
    }
}
