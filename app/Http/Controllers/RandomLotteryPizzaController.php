<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prizes;
use App\Participants;

class RandomLotteryPizzaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (session('idParticipants') != null) {
            $participants = Participants::find(session('idParticipants'));
            if($participants->type == 'ALL') {
                $prizes = Prizes::where('is_taken', null)->get();
            } else {
                $prizes = Prizes::where('type', $participants->type)->where('is_taken', null)->get();
            }
            return view('contents.random_lottery_pizza', compact('participants', 'prizes'));
        } else {
            return redirect('/contents/name')->with('warning', 'Harap undi nama terlebih dahulu!');
        }
    }

    public function onDecisionPrize(Request $request, $id) {
        $prizes = Prizes::find($id);
        $prizes->is_taken = $request->is_taken;
        
        $prizes->save();

        if($request->is_taken == 1) {
            $participants = Participants::find(session('idParticipants'));
            $participants->prize_id = $prizes->id;
            $participants->save();
        } else {
            $participants = Participants::find(session('idParticipants'));
            $participants->is_choosen = 0;
            $participants->prize_id = null;
            $participants->save();
        }

        session(['idParticipants' => null]);

        if($request->is_taken == 1) {
            return redirect('/')->with('success', 'Kocok undian sukses!');
        } else {
            return redirect('/contents/name')->with('warning', 'Peserta tidak ada/tidak hadir.');
        }
    }
}
