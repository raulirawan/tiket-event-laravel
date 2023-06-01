<?php

namespace App\Http\Controllers\Admin;

// use Barryvdh\DomPDF\PDF;

use PDF;
use App\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PrintController extends Controller
{
    public function printTiket($id)
    {   
        $EventUser = EventUser::with(['user','event'])->findOrFail($id);
        $customPaper = array(0,0,298,420);
        $pdf = PDF::loadView('pages.print.index-tiket', compact('EventUser'));
        $pdf->setPaper($customPaper,'potrait');
        return $pdf->stream("$EventUser->code.pdf", array("Attachment" => false));
        exit(0);
    }
}
