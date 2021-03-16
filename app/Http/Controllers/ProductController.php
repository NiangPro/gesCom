<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        $request->validate([
            'type' => 'required',
            'nom' => 'required',
            'description' => 'required',
            'taxe' => 'required|integer',
            'tarif' => 'required|integer',
        ]);

        $p = new Product();

        $p->nom = $request['nom'];
        $p->type = $request['type'];
        $p->description = $request['description'];
        $p->tarif = $request['tarif'];
        $p->taxe = $request['taxe'];

        $p->save();
        $this->histo->addHistorique("Un produit ou une service a été ajouté", "Ajout");


        return $this->refresh();
    }

    public function allProducts()
    {
        $prods = Product::orderBy('nom', 'ASC')->get();

        return response()->json($prods);
    }

    public function getNbreProducts()
    {
        $total = DB::table('products')->count();
        return response()->json($total);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Product::where('id', $id)->first();

        return response()->json($prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'type' => 'required',
            'nom' => 'required',
            'description' => 'required',
            'taxe' => 'required|integer',
            'tarif' => 'required|integer',
        ]);

        $prod = Product::where('id', $id)->first();

        $prod->nom = request('nom');
        $prod->type = request('type');
        $prod->description = request('description');
        $prod->tarif = request('tarif');
        $prod->taxe = request('taxe');

        $prod->save();
        $this->histo->addHistorique("Les informations d'un produit ou service ont été mises à jour", "Modification");


        return $this->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Product::where('id', $id)->first();

        $prod->delete();

        $this->histo->addHistorique("Un produit ou service a été supprimé", "Suppression");

        return $this->refresh();
    }

    private function refresh()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(6);

        return response()->json($products);
    }
}
