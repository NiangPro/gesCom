<?php

namespace App\Http\Controllers;

use App\Models\Employed;
use App\Models\History;
use Illuminate\Http\Request;

class EmployeController extends Controller
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
        $employe = Employed::create($request->all());

        if ($employe) {
            $this->histo->addHistorique("Un employé a été ajouté", "Ajout");
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
        $em = Employed::where('id', $id)->first();

        return response()->json($em);
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
        $em = Employed::where('id', $id)->first();

        $em->prenom = request('prenom');
        $em->nom = request('nom');
        $em->email = request('email');
        $em->tel = request('tel');
        $em->fonction = request('fonction');
        $em->adresse = request('adresse');

        $em->save();

        $this->histo->addHistorique("Les informations d'un employé ont été mises à jour", "Modification");

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
        $emp = Employed::where('id', $id)->first();

        if ($emp->delete()) {
            $this->histo->addHistorique("Un employé a été supprimé", "Suppression");
            return $this->refresh();
        } else {
            return response()->json(['message' => 'Erreur de suppression'], 425);
        }
    }

    private function refresh()
    {
        $employes = Employed::orderBy('id', 'DESC')->get();

        return response()->json($employes);
    }

    public function editProfil(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $image = $request->file('image');
        $imageName = time() . '.jpg';

        $image->move(public_path('/images/employed/'), $imageName);

        return response()->json($imageName);
    }
}
