<?php

namespace App\Http\Controllers;

use App\Models\ProduitVendu;
use App\Models\Vente;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    private $histo;

    public function __construct()
    {
        // $this->middleware('auth');
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

        $sale = new Vente();
        $sale->date = $request->date;
        $sale->client_id = $request->client_id;
        $sale->employed_id = $request->employed_id;
        $sale->description = $request->description;
        $sale->discount = $request->discount;
        $sale->total_amount = $request->total_amount;


        $sale->save();

        foreach ($request->allProducts as $prod) {

            ProduitVendu::create([
                'nom' => $prod['nom'],
                'qte' => $prod['qte'],
                'description' => $prod['description'],
                'taxe' => $prod['taxe'],
                'amount' => $prod['amount'],
                'vente_id' => $sale->id
            ]);
        }

        $this->histo->addHistorique("Une vente a été enregistrée", "Ajout");

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
        $vente = Vente::with('client', 'employed')->where('id', $id)->first();

        return response()->json($vente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vente = Vente::where('id', $id)->first();

        $vente->delete();
        $this->histo->addHistorique("Une vente a été supprimée", "Suppression");


        return $this->refresh();
    }

    public function cancel($id)
    {
        $vente = Vente::where('id', $id)->first();

        $vente->delete();

        return $this->refresh();
    }

    public function getProducts($id)
    {
        $products = ProduitVendu::where('vente_id', $id)->get();

        return response()->json($products);
    }

    public function refresh()
    {
        $ventes = Vente::with('client', 'employed')->orderBy('id', 'DESC')->get();

        return response()->json($ventes);
    }

    public function produitVendus()
    {
        $produitVendus = ProduitVendu::with('vente')->orderBy('vente_id', 'DESC')->get();

        return response()->json($produitVendus);
    }

    public function getNbreVentes()
    {
        $total = DB::table('ventes')->count();
        return response()->json($total);
    }
}
