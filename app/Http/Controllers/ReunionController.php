<?php

namespace App\Http\Controllers;

use App\Models\Reunion;
use App\Models\History;
use Illuminate\Http\Request;

class ReunionController extends Controller
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

    public function getCalendar()
    {
        $events = Reunion::get(['titre', 'date']);
        return response()->json(["events" => $events]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reunion = new Reunion();

        $this->assign($request, $reunion);
        $this->histo->addHistorique("Un réunion a été ajouté", "Ajout");

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
        $reunion = Reunion::where('id', $id)->first();

        return response()->json($reunion);
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
        $reunion = Reunion::where('id', $id)->first();

        $this->assign($request, $reunion);
        $this->histo->addHistorique("Les informations d'un réunion ont été mises à jour", "Modification");

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
        $reunion = Reunion::where('id', $id)->first();

        $reunion->delete();
        $this->histo->addHistorique("Un réunion a été supprimé", "Suppression");

        return $this->refresh();
    }

    private function refresh()
    {
        $reunions = Reunion::orderBy('id', 'DESC')->get();

        return response()->json($reunions);
    }

    private function assign(Request $request, Reunion $reunion)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        $reunion->titre = $request->titre;
        $reunion->description = $request->description;
        $reunion->date = $request->date;

        $reunion->save();
    }
}
