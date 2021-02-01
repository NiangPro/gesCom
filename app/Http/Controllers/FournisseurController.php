<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
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
        Fournisseur::create($request->all());

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
        $fr = Fournisseur::where('id', $id)->first();

        return response()->json($fr);
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
    public function update($id)
    {
        $fr = Fournisseur::where('id', $id)->first();

        $fr->prenom = request('prenom');
        $fr->nom = request('nom');
        $fr->pays = request('pays');
        $fr->email = request('email');
        $fr->tel = request('tel');
        $fr->adresse = request('adresse');

        $fr->save();

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
        $fr = Fournisseur::where('id', $id)->first();

        if ($fr->delete()) {
            return $this->refresh();
        } else {
            return response()->json(['message' => 'erreur de suppression'], 425);
        }
    }

    private function refresh()
    {
        $frs = Fournisseur::orderBy('id', 'DESC')->get();

        return response()->json($frs);
    }
}
