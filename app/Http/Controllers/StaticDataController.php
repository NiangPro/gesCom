<?php

namespace App\Http\Controllers;

use App\Models\StaticData;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Static_;

class StaticDataController extends Controller
{
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
        $sd = StaticData::where('id', $id)->first();

        $sd->type = request('type');
        $sd->label = request('type');
        $sd->valeur = request('valeur');

        $result = $sd->save();

        if ($result) {
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

        if ($sd->delete()) {
            return $this->refresh();
        } else {
            return response()->json(['error' => 'Erreur de suppression'], 425);
        }
    }

    public function getFonction()
    {
        $sds = StaticData::where('type', "type de fonction")->get();

        return response()->json($sds);
    }

    private function refresh()
    {
        $staticDatas = StaticData::all();

        return response()->json($staticDatas);
    }
}
