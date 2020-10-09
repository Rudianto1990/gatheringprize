<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\WinnerExport;
use App\Participants;
use App\Prizes;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(session('idParticipants') != null) {
            $participant = Participants::find(session('idParticipants'));
            $participant->is_choosen = null;
            $participant->save();
            session(['idParticipants' => null]);
        }
        session(['role' => Auth::user()->role]);
        $participants = Participants::where('prize_id', '!=', null)->paginate(10);
        return view('home', compact('participants'));
    }

    public function exportExcel() {
        return Excel::download(new WinnerExport, 'winner.xlsx');
    }
}
