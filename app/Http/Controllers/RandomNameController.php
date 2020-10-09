<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participants;

class RandomNameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        if(session('idParticipants') != null) {
            $participant = Participants::find(session('idParticipants'));
            $participant->is_choosen = null;
            $participant->save();
            session(['idParticipants' => null]);
        }
        $participants = Participants::where('is_choosen', null)->get();
        return view('contents.random_name', compact('participants'));
    }

    public function roulette() {
        if(session('idParticipants') != null) {
            $participant = Participants::find(session('idParticipants'));
            $participant->is_choosen = null;
            $participant->save();
            session(['idParticipants' => null]);
        }
        $participants = Participants::where('is_choosen', null)->get();  
        return view('contents.random_name_pizza', compact('participants'));
    }

    public function onDecision(Request $request, $id) {
        $request->validate([
            'is_choosen' => 'required'
        ]);
        
        if(request()->is_choosen == 1) {
            session(['idParticipants' => $id]);
        } else {
            session(['idParticipants' => null]);
        }

        $participants = Participants::find($id);
        $participants->is_choosen = $request->is_choosen;
        
        $participants->save();
        
        if ($request->is_choosen == 1) {
            return redirect('/contents/lottery-table')->with('success', 'Klik tombol Kocok Undian untuk mengocok undian');
        } else {
            return redirect('/contents/name')->with('warning', 'Peserta tidak ada/tidak hadir.');
        }
        
    }
}
