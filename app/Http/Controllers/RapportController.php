<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    public function getSumBetweenTwoDate(Request $request)
    {
        $resultat = [];
        $vente = DB::table("ventes")
            ->whereBetween(DB::raw("DATE(date)"), [$request->dateFrom, $request->dateTo])
            ->groupBy(DB::raw("DATE(date)"))
            ->sum("total_amount");
        $depense = DB::table("expenses")
            ->whereBetween(DB::raw("DATE(date)"), [$request->dateFrom, $request->dateTo])
            ->groupBy(DB::raw("DATE(date)"))
            ->sum("montant");

        $resultat['vente'] = $vente;
        $resultat['depense'] = $depense;
        $resultat['from'] = $request->dateFrom;
        $resultat['to'] = $request->dateTo;

        return response()->json($resultat);
    }
}
