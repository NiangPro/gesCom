<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Models\History;
use Illuminate\Http\Request;

class ProspectController extends Controller
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
        $p = new Prospect();

        $this->assign($request, $p);
        $this->histo->addHistorique("Un prospect a été ajouté", "Ajout");

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
        $p = Prospect::where('id', $id)->first();

        return response()->json($p);
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
        $p = Prospect::where('id', $id)->first();

        $this->assign($request, $p);
        $this->histo->addHistorique("Les informations d'un prospect ont été mises à jour", "Modification");

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
        $p = Prospect::where('id', $id)->first();

        $p->delete();
        $this->histo->addHistorique("Un prospect a été supprimé", "Suppression");

        return $this->refresh();
    }

    private function assign(Request $request, Prospect $p)
    {
        $request->validate([
            'sujet' => 'required',
            'pays' => 'required',
            'email' => 'required',
            'adresse' => 'required',
            'source' => 'required',
            'assignation' => 'required',
            'tel' => 'required'
        ]);


        $p->sujet = $request['sujet'];
        $p->source = $request['source'];
        $p->email = $request['email'];
        $p->adresse = $request['adresse'];
        $p->pays = $request['pays'];
        $p->assignation = $request['assignation'];
        $p->tel = $request['tel'];

        $p->save();
    }

    private function refresh()
    {
        $ps = Prospect::orderBy('id', 'DESC')->get();

        return response()->json($ps);
    }
}
