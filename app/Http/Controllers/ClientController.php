<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        $cli = Client::create($request->all());

        if ($cli) {
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
        $cli = Client::where('id', $id)->first();

        $cli->prenom = request('prenom');
        $cli->nom = request('nom');
        $cli->email = request('email');
        $cli->tel = request('tel');
        $cli->pays = request('pays');
        $cli->adresse = request('adresse');

        $cli->save();

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
            return $this->refresh();
        } else {
            return response()->json(['message' => 'Erreur de suppression'], 425);
        }
    }

    public function getCountry()
    {
        $pays = Country::orderBy('nom_fr', 'ASC')->get();

        return response()->json($pays);
    }

    private function refresh()
    {
        $clients = Client::orderBy('id', 'DESC')->get();

        return response()->json($clients);
    }
}
