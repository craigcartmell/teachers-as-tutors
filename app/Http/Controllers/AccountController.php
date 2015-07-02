<?php

namespace TeachersAsTutors\Http\Controllers;

use TeachersAsTutors\Http\Requests;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('account.index');
    }
}
