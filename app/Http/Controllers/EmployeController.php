<?php

namespace App\Http\Controllers;

use App\Models\Employed;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $em = new Employed();
        $em->prenom = $request->prenom;
        $em->nom = $request->nom;
        $em->email = $request->email;
        $em->tel = $request->tel;
        $em->fonction = $request->fonction;
        $em->adresse = $request->adresse;
        $em->sexe = $request->sexe;

        if ($request->sexe === "Homme") {
            $em->profil = "user-male.png";
        } else {
            $em->profil = "user-female.png";
        }

        $em->save();

        $this->histo->addHistorique("Un employé a été ajouté", "Ajout");
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
        $em->sexe = request('sexe');

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

    public function allEmployes()
    {
        $emps = Employed::orderBy('prenom', 'ASC')->get();

        return response()->json($emps);
    }

    private function refresh()
    {
        $employes = Employed::orderBy('id', 'DESC')->paginate(8);

        return response()->json($employes);
    }

    public function getNbreEmployes()
    {
        $total = DB::table('employeds')->count();
        return response()->json($total);
    }

    public function editProfil(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = 'employe' . md5($request->empId) . '.jpg';

            $request->image->storeAs('public/images', $imageName);

            $emp = Employed::where('id', $request->empId)->first();

            $emp->profil = $imageName;
            $emp->save();

            $this->histo->addHistorique("L'image de profil d'un employé a été mise à jour", "Modification");
        }

        return $this->refresh();
    }
}
