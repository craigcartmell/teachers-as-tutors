<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use TeachersAsTutors\Folder;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Resource;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::all();

        return view('folders.index', ['folders' => $folders,]);
    }

    public function getEditFolder(Request $request, $id = 0)
    {
        $folder = new Resource();

        if ($id) {
            $folder = Folder::query()->findOrFail($id);
        }

        return view('folders.edit', ['folder' => $folder,]);
    }

    public function postEditFolder(Request $request, $id = 0)
    {
        $folder = new Folder();

        if ($id) {
            $folder = Folder::query()->findOrFail($id);
        }

        $this->validate($request, ['name' => 'required|unique:folders,name,' . $id,]);

        $folder->name = $request->input('name');

        $folder->save();

        if (empty($id)) {
            return redirect()->route('folders.edit', ['id' => $folder->getKey()])->with([
                'success' => true,
            ]);
        }

        return redirect()->back()->with('success', true);
    }

    public function deleteFolder(Request $request, $id)
    {
        $folder = Folder::query()->findOrFail($id);

        if (! auth()->user()->is_admin && auth()->user()->getKey() !== $folder->created_by) {
            $errors = ['You do not have permission to delete this folder.'];

            if ($request->ajax()) {
                return response(['errors' => $errors], 403);
            }

            return redirect()->back()->withErrors($errors);
        }

        $folder->delete();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }
}
