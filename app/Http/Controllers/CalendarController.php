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

        return view('calendar.index', ['parents' => $parents]);
    }

    public function getInvoice($invoiceDate)
    {
        $invoiceDate = Carbon::createFromFormat('Y-m', $invoiceDate);

        if (auth()->user()->is_parent) {
            $parent_id = auth()->user()->getAuthIdentifier();
            $tutor_id  = 0;
        } else {
            $parent_id = 0;
            $tutor_id  = auth()->user()->getAuthIdentifier();
        }

        $invoice = new Invoice($invoiceDate, $tutor_id, $parent_id);

        return $invoice->generate();
    }
}
