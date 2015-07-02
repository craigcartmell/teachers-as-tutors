<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Request;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Http\Controllers\Controller;
use TeachersAsTutors\User;
use TeachersAsTutors\UserPermission;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function getUsers()
    {
        $users = User::with('permission')->get();

        return view('admin.users.index', ['users' => $users]);
    }

    public function getEditUser(Request $request, $id = 0)
    {
        $user = new User();

        if ($id) {
            $user = User::query()->findOrFail($id);
        }
        $permissions = UserPermission::all();

        return view('admin.users.edit', ['user' => $user, 'permissions' => $permissions]);
    }

    public function postEditUser(Request $request, $id = 0)
    {
        $user = new User();

        if ($id) {
            $user = User::query()->findOrFail($id);
        }

        $this->validate($request,
            [
                'name'               => 'required',
                'email'              => 'required|email',
                'password'           => ! empty($id) ? 'sometimes|' : '' . 'required|confirmed',
                'password_confirmed' => 'required_with:password',
                'permission_id'      => 'exists:user_permissions,id',
            ], ['permission_id.exists' => 'Please select an account type.']);

        $user->name          = $request->input('name');
        $user->email         = $request->input('email');
        $user->permission_id = $request->input('permission_id');

        $user->save();

        return redirect()->back()->with('success', true);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);

        $user->delete();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->route('admin.users');
    }

    public function enableUser(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);

        $user->is_enabled = ! $user->is_enabled;

        $user->save();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->route('admin.users');
    }
}
