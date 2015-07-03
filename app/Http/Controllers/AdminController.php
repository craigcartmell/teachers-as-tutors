<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Http\Controllers\Controller;
use TeachersAsTutors\Page;
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

    public function postEditUser(Request $request, Mailer $mailer, TokenRepositoryInterface $tokens, $id = 0)
    {
        $user = new User();

        $rules = [
            'name'          => 'required',
            'email'         => 'required|email|confirmed|unique:users,email,' . $id,
            'password'      => 'confirmed',
            'permission_id' => 'exists:user_permissions,id',
            'is_enabled'    => 'boolean',
        ];

        if ($id) {
            $user = User::query()->findOrFail($id);

            $rules['password'] = 'sometimes|confirmed';
        }

        $this->validate($request, $rules, ['permission_id.exists' => 'Please select an account type.']);

        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        if (! empty($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->permission_id = $request->input('permission_id');
        $user->is_enabled    = $request->input('is_enabled');

        $user->save();

        if (empty($id)) {
            $token = $tokens->create($user);

            $mailer->send('emails.welcome', ['user' => $user, 'token' => $token], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Welcome to ' . env('APP_NAME'));
            });

            return redirect()->route('admin.users.edit', ['id' => $user->getKey()])->with([
                'success' => true,
                'is_new'  => true
            ]);
        }

        return redirect()->back()->with('success', true);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);

        $user->delete();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }

    public function enableUser(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);

        $user->is_enabled = ! $user->is_enabled;

        $user->save();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }

    public function getPages()
    {
        $pages = Page::query()->with('children')->whereNull('parent_id')->get();

        return view('admin.pages.index', ['pages' => $pages]);
    }

    public function getEditPage(Request $request, $id = 0)
    {
        $page = new Page();

        if ($id) {
            $page = Page::query()->findOrFail($id);
        }

        $pages = Page::query()->where('id', '!=', $id)->get();

        return view('admin.pages.edit', ['page' => $page, 'pages' => $pages]);
    }

    public function postEditPage(Request $request, $id = 0)
    {
        $page = new Page();

        if ($id) {
            $page = Page::query()->findOrFail($id);
        }

        $rules = [
            'name'       => 'required|unique:pages,name,' . $id,
            'uri'        => 'required|unique:pages,uri,' . $id,
            'content'    => 'required',
            'is_enabled' => 'boolean'
        ];

        if (! empty($request->input('parent_id'))) {
            $rules['parent_id'] = 'exists:pages,id';
        }

        $this->validate($request, $rules);

        $page->parent_id      = $request->input('parent_id') ?: null;
        $page->name           = $request->input('name');
        $page->uri            = $request->input('uri');
        $page->hero_image_uri = $request->input('hero_image_uri');
        $page->hero_text      = $request->input('hero_text');
        $page->content        = $request->input('content');
        $page->is_enabled     = $request->input('is_enabled');

        $page->save();

        if (empty($id)) {
            return redirect()->route('admin.pages.edit', ['id' => $page->getKey()])->with([
                'success' => true,
            ]);
        }

        return redirect()->back()->with('success', true);
    }

    public function deletePage(Request $request, $id)
    {
        $page = Page::query()->findOrFail($id);

        $page->delete();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }

    public function enablePage(Request $request, $id)
    {
        $page = Page::query()->findOrFail($id);

        $page->is_enabled = ! $page->is_enabled;

        $page->save();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }
}
