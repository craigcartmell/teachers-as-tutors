<?php

namespace TeachersAsTutors\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Services\Invoice;
use TeachersAsTutors\User;

class CalendarController extends Controller
{
    /**
     * Display the calendar landing page
     *
     * @return View
     */
    public function index()
    {
        $parents = User::query()->where('permission_id', 3)->get();

        return view('calendar.index', ['parents' => $parents,]);
    }

    public function getInvoice($parentSlug, $parentID, $invoiceDate, $download = false)
    {
        $invoiceDate = Carbon::createFromFormat('Y-m', $invoiceDate);
        $invoice     = new Invoice($invoiceDate, intval($parentID));

        if ($download) {
            $dompdf = new \DOMPDF();
            $dompdf->load_html(view('calendar.invoice', $invoice->generate())->render());
            $dompdf->set_paper('a4', 'portrait');
            $dompdf->render();
            $pdf = $dompdf->output();
            Storage::put('test.pdf', $pdf);
        }

        return view('calendar.invoice', $invoice->generate());
    }
}
