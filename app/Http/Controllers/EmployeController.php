<?php

namespace App\Http\Controllers;

use App\Models\Employed;
use Illuminate\Http\Request;

class EmployeController extends Controller
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
        $employe = Employed::create($request->all());

        if ($employe) {
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
        $em = Employed::where('id', $id)->first();

        $em->prenom = request('prenom');
        $em->nom = request('nom');
        $em->email = request('email');
        $em->tel = request('tel');
        $em->fonction = request('fonction');
        $em->adresse = request('adresse');

        $em->save();

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
}
