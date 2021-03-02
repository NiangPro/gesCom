<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function getSumBetweenTwoDate($date_from, $date_to)
    {
        $montant = DB::table("ventes")
            ->whereBetween("date", [$date_from, $date_to])
            ->selectRaw("sum(total_amount)")
            ->get();

        return response()->json($montant);
    }
}
