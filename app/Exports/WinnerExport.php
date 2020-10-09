<?php

namespace App\Exports;

use App\Participants;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WinnerExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.winner', [
            'participants' => Participants::where('prize_id', '!=', null)->get()
        ]);
    }
}
