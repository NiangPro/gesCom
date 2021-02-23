<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    private $histo;

    public function __construct()
    {
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
            'titre' => 'required',
            'date' => 'required'
        ]);

        $todo = new Todolist();

        $todo->titre = $request->titre;
        $todo->date = $request->date;
        $todo->is_check = 0;
        $todo->user_id = Auth::user()->id;

        $todo->save();

        $this->histo->addHistorique("Une tâche à faire a été ajouté", "Ajout");

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
        $todo = Todolist::where('id', $id)->first();

        return response()->json($todo);
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
        $request->validate([
            'titre' => 'required',
            'date' => 'required'
        ]);

        $todo = Todolist::where('id', $id)->first();

        $todo->titre = $request->titre;
        $todo->date = $request->date;

        $todo->save();
        $this->histo->addHistorique("Les informations d'une tâche à faire ont été mises à jour", "Modification");

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
        $todo = Todolist::where('id', $id)->first();

        $todo->delete();
        $this->histo->addHistorique("Une tâche à faire a été supprimé", "Suppression");

        return $this->refresh();
    }

    private function refresh()
    {
        $todos = Todolist::orderBy('date', 'DESC')->take(6)->get();

        return response()->json($todos);
    }

    public function todoCheck(Request $request)
    {
        $todo = Todolist::where('id', $request->id)->first();

        $todo->is_check = $request->is_check;
        $todo->save();
        $this->histo->addHistorique("Le statut d'une tâche à faire a été mises à jour", "Modification");

        return $this->refresh();
    }
}
