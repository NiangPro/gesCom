<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $prod = Product::where('id', $id)->first();

        return response()->json($prod);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        return $this->refresh();
    }

    private function refresh()
    {
        $products = Product::orderBy('id', 'DESC')->get();

        return response()->json($products);
    }
}
