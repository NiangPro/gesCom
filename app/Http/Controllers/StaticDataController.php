<?php

namespace App\Http\Controllers;

use App\Models\StaticData;
use App\Models\History;
use Illuminate\Http\Request;

class StaticDataController extends Controller
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
        $staticDatas = StaticData::all()->groupBy('type');

        return response()->json($staticDatas);
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
        $staticData = StaticData::create($request->all());

        if ($staticData) {
            $this->histo->addHistorique("Une donnée statique a été ajouté", "Ajout");
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
        $sd = StaticData::where('id', $id)->first();

        return response()->json($sd);
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
        $sd = StaticData::where('id', $id)->first();

        $sd->type = request('type');
        $sd->label = request('type');
        $sd->valeur = request('valeur');

        $result = $sd->save();

        if ($result) {
            $this->histo->addHistorique("Les informations d'une donnée statique ont été mises à jour", "Modification");

            return $this->refresh();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sd = StaticData::where('id', $id)->first();

        $sd->delete();
        $this->histo->addHistorique("Une donnée statique a été supprimé", "Suppression");

        return $this->refresh();
    }

    public function getFonction()
    {
        $sds = StaticData::where('type', "Type de fonction")->get();

        return response()->json($sds);
    }

    private function refresh()
    {
        $staticDatas = StaticData::all();

        return response()->json($staticDatas);
    }
}
