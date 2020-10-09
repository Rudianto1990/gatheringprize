<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Participants;

class UserSettingController extends Controller
{
    public function index() {
        if(session('idParticipants') != null) {
            $participant = Participants::find(session('idParticipants'));
            $participant->is_choosen = null;
            $participant->save();
            session(['idParticipants' => null]);
        }
        $users = User::all();
        return view('settings.user', compact('users'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => $request->get('role')
        ]);

        $user->save();
        return redirect('/settings/user')->with('success', 'Berhasil membuat user');
    }

    public function update(Request $request, $id) {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
            ]);
            
        $user = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect('/settings/user')->with('success', 'Berhasil mengubah data user');
    }

    public function destroy(Request $request) {
        $user = User::find($request->id);
        $user->delete();

        return redirect()->back()->with('success', 'Data user berhasil dihapus!');
    }
}
