<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();

        $this->assign($request, $task);

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
        $task = Task::where('id', $id)->first();

        return response()->json($task);
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
        $task = Task::where('id', $id)->first();

        $this->assign($request, $task);

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
        $task = Task::where('id', $id)->first();

        $task->delete();

        return $this->refresh();
    }

    private function refresh()
    {
        $tasks = Task::orderBy('id', 'DESC')->get();

        return response()->json($tasks);
    }

    private function assign(Request $request, Task $task)
    {
        $request->validate([
            'titre' => 'required',
            'type' => 'required',
            'statut' => 'required',
            'execution' => 'required',
            'description' => 'required',
            'assignation' => 'required'
        ]);


        $task->titre = $request['titre'];
        $task->type = $request['type'];
        $task->statut = $request['statut'];
        $task->execution = $request['execution'];
        $task->description = $request['description'];
        $task->assignation = $request['assignation'];

        $task->save();
    }
}
