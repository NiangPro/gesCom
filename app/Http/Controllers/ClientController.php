<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\History;
use Illuminate\Http\Request;


class ClientController extends Controller
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
        $cli = Client::create($request->all());

        if ($cli) {
            $this->histo->addHistorique("Un client a été ajouté", "Ajout");
            return $this->refresh();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cli = Client::where('id', $id)->first();

        return response()->json($cli);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $cli = Client::where('id', $id)->first();

        $cli->nom = $request->nom;
        $cli->email = $request->email;
        $cli->tel = $request->tel;
        $cli->pays = $request->pays;
        $cli->adresse = $request->adresse;

        $cli->save();

        $this->histo->addHistorique("Les informations d'un client ont été mises à jour", "Modification");

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
        $cli = Client::where('id', $id)->first();

        if ($cli->delete()) {
            $this->histo->addHistorique("Un client a été supprimé", "Suppression");
            return $this->refresh();
        } else {
            return response()->json(['message' => 'Erreur de suppression'], 425);
        }
    }


    private function refresh()
    {
        $clients = Client::orderBy('id', 'DESC')->get();

        return response()->json($clients);
    }
}
