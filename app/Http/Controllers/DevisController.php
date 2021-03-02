<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\History;
use App\Models\DevisItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevisController extends Controller
{
    private $histo;
    public function __construct()
    {
        $this->histo = new History();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->refresh();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $devis = new Devis();
        $devis->date = $request->date;
        $devis->client_id = $request->client_id;
        $devis->employed_id = $request->employed_id;
        $devis->description = $request->description;
        $devis->discount = $request->discount;
        $devis->total_amount = $request->total_amount;
        $devis->statut = $request->statut;


        $devis->save();

        foreach ($request->allProducts as $prod) {

            DevisItem::create([
                'nom' => $prod['nom'],
                'qte' => $prod['qte'],
                'description' => $prod['description'],
                'taxe' => $prod['taxe'],
                'amount' => $prod['amount'],
                'devis_id' => $devis->id
            ]);
        }

        $this->histo->addHistorique("Un devis a été enregistré", "Ajout");

        return $this->refresh();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devis = Devis::with('client', 'employed')->where('id', $id)->first();

        return response()->json($devis);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $devis = Devis::where('id', $id)->first();

        $devis->delete();

        return $this->refresh();
    }

    private function refresh()
    {
        $devis = Devis::with('client', 'employed')->orderBy('id', 'DESC')->get();

        return response()->json($devis);
    }

    public function devisItems()
    {
        $devisItems = DevisItem::with('devis')->orderBy('devis_id', 'DESC')->get();

        return response()->json($devisItems);
    }

    public function itemsDevis($id)
    {
        $devisItems = DevisItem::where('devis_id', $id)->get();

        return response()->json($devisItems);
    }

    public function totalDevis()
    {
        $total = DB::table('devis')->count();
        return response()->json($total);
    }
}
