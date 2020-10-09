<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Prizes;
use App\Participants;
use App\Imports\PrizesImport;
use App\Http\Controllers\Controller;

class PrizesController extends Controller
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
        $prizes = Prizes::paginate(10);
        return view('lists.prizes', compact('prizes'));
    }

    public function store(Request $request) {
        
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'size' => 'required',
        ]);
            
        if(request()->file != null) {
            $imageName = time().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('storage'), $imageName);
        }
        
        $prizes = new Prizes([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'size' => $request->get('size'),
        ]);

        if(request()->file != null) {
            $prizes->file = $imageName;
        }

        $prizes->save();
        return redirect('/lists/prizes')->with('success', 'Data hadiah berhasil disimpan!');
    }

    public function importExcel(Request $request) {
        $file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('file_hadiah',$nama_file);
        Excel::import(new PrizesImport, public_path('/file_hadiah/'.$nama_file));
        return redirect('/lists/prizes')->with('success', 'Data berhasil diimport!');
    }
}
