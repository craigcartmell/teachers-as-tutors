<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\View\View;
use TeachersAsTutors\Http\Requests;
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
}
