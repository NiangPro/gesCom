<?php

namespace App\Http\Controllers;

use App\Models\History;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    // public function __construct()
    // {
    //     if (!Auth::user()) {

    //         return redirect("login");
    //     }
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->refresh();
    }
    public function refresh()
    {
        $histories = History::with('user')->orderBy('id', 'DESC')->paginate(7);

        return response()->json($histories);
    }
}
