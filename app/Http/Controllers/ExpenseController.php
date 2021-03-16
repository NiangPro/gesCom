<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\History;
use Illuminate\Http\Request;

class ExpenseController extends Controller
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
        $expense = new Expense();

        $this->assign($request, $expense);
        $this->histo->addHistorique("Une dépense a été ajouté", "Ajout");


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
        $expense = Expense::where('id', $id)->first();

        return response()->json($expense);
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
        $expense = Expense::where('id', $id)->first();

        $this->assign($request, $expense);
        $this->histo->addHistorique("Les informations d'une dépense ont été mises à jour", "Modification");

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
        $expense = Expense::where('id', $id)->first();

        $expense->delete();
        $this->histo->addHistorique("Une dépense a été supprimée", "Suppression");

        return $this->refresh();
    }

    private function refresh()
    {
        $expenses = Expense::orderBy('date', 'DESC')->paginate(6);

        return response()->json($expenses);
    }

    private function assign(Request $request, Expense $expense)
    {
        $request->validate([
            'category' => 'required',
            'payment_mode' => 'required',
            'montant' => 'required',
            'date' => 'required'
        ]);


        $expense->category = $request->category;
        $expense->payment_mode = $request->payment_mode;
        $expense->montant = $request->montant;
        $expense->description = $request->description;
        $expense->date = $request->date;
        $expense->recu = $request->recu;

        $expense->save();
    }
}
