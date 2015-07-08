<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Request;
use TeachersAsTutors\Http\Requests;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getProfile()
    {
        return view('profile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postProfile(Request $request)
    {
        $this->validate($request,
            ['name'     => 'required|max:255',
             'email'    => 'required|email|confirmed|unique:users,email,' . auth()->user()->getKey(),
             'password' => 'sometimes|confirmed'
            ]);

        auth()->user()->name  = $request->input('name');
        auth()->user()->email = $request->input('email');
        if ($request->input('password')) {
            auth()->user()->password = bcrypt($request->input('password'));
        }

        auth()->user()->save();

        return redirect()->back()->with('success', true);
    }
}
