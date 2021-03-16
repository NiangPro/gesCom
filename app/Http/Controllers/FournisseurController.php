<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\History;
use Illuminate\Http\Request;

class FournisseurController extends Controller
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
        Fournisseur::create($request->all());

        $this->histo->addHistorique("Un fournisseur a été ajouté", "Ajout");


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

        $this->histo->addHistorique("Les informations d'un fournisseur ont été mises à jour", "Modification");

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
            $this->histo->addHistorique("Un fournisseur a été supprimé", "Suppression");
            return $this->refresh();
        } else {
            return response()->json(['message' => 'erreur de suppression'], 425);
        }
    }

    private function refresh()
    {
        $frs = Fournisseur::orderBy('id', 'DESC')->paginate(6);

        return response()->json($frs);
    }
}
