<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Participants;
use App\Prizes;
use App\Imports\ParticipantsImport;
use App\Http\Controllers\Controller;


class ParticipantsController extends Controller
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
        $participants = Participants::where('is_choosen', null)->paginate(10);
        return view('lists.participants', compact('participants'));
    }
    
    public function store(Request $request) {
        
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        $participants = new Participants([
           'name' => $request->get('name'),
           'type' => $request->get('type') 
        ]);

        $participants->save();
        return redirect('lists/participants')->with('success', 'Data peserta berhasil disimpan!');
    }

    public function importExcel(Request $request) {
        $file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('file_peserta',$nama_file);
        Excel::import(new ParticipantsImport, public_path('/file_peserta/'.$nama_file));
        return redirect('/lists/participants')->with('success', 'Data berhasil diimport!');
    }
}
