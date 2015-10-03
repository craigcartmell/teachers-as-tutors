<?php

namespace TeachersAsTutors\Http\Controllers;

use Carbon\Carbon;
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

    public function getInvoice($parentSlug, $parentID, $invoiceDate)
    {
        $invoiceDate = Carbon::createFromFormat('Y-m', $invoiceDate);
        $invoice     = new Invoice($invoiceDate, intval($parentID));

        return $invoice->generate();
    }
}
