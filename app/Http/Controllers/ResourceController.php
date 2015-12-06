<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use TeachersAsTutors\Folder;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        $folders   = Folder::all();
        $folder_id = Input::get('folder_id', 0);
        $resources = $folder_id
            ? Resource::query()->where('folder_id', $folder_id)->get()
            : Resource::all();

        return view('resources.index', ['resources' => $resources, 'folders' => $folders, 'folder_id' => $folder_id,]);
    }

    public function getEditResource(Request $request, $id = 0)
    {
        $resource = new Resource();

        if ($id) {
            $resource = Resource::query()->findOrFail($id);
        }

        $folders = Folder::all();

        return view('resources.edit', ['resource' => $resource, 'folders' => $folders,]);
    }

    public function postEditResource(Request $request, $id = 0)
    {
        $resource = new Resource();

        if ($id) {
            $resource = Resource::query()->findOrFail($id);
        }

        $folder_id = $request->input('folder_id') ? $request->input('folder_id') : null;

        $this->validate($request, [
            'folder_id'         => $folder_id ? 'exists:folders,id' : '',
            'desc'              => 'max:255',
            'original_filename' => ! $id ? 'required|max:' . env('MAX_UPLOAD_SIZE') : '',
        ],
            ['original_filename.required' => 'Please select a file to upload.']);


        $resource->folder_id  = $folder_id;
        $resource->desc       = $request->input('desc');
        $resource->is_enabled = $request->input('is_enabled', 0);

        if ($request->file('original_filename')) {
            $file = $request->file('original_filename');

            $filename = str_slug(basename($file->getClientOriginalName(),
                        '.' . $file->getClientOriginalExtension()) . '-' . uniqid()) . '.' . $file->getClientOriginalExtension();

            $file->move(storage_path('app/resources'), $filename);

            $resource->original_filename = $file->getClientOriginalName();
            $resource->filename          = $filename;
            $resource->size              = $file->getClientSize();
            $resource->extension         = $file->getClientOriginalExtension();
            $resource->mime_type         = $file->getClientMimeType();
        }

        $resource->save();

        if (empty($id)) {
            return redirect()->route('resources.edit', ['id' => $resource->getKey()])->with([
                'success' => true,
            ]);
        }

        return redirect()->back()->with('success', true);
    }

    public function deleteResource(Request $request, $id)
    {
        $resource = Resource::query()->findOrFail($id);

        if (! auth()->user()->is_admin && auth()->user()->getKey() !== $resource->created_by) {
            $errors = ['You do not have permission to delete this resource.'];

            if ($request->ajax()) {
                return response(['errors' => $errors], 403);
            }

            return redirect()->back()->withErrors($errors);
        }

        $resource->delete();

        if (file_exists($resource->full_file_path)) {
            unlink($resource->full_file_path);
        }

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }

    public function enableResource(Request $request, $id)
    {
        $resource = Resource::query()->findOrFail($id);

        $resource->is_enabled = ! $resource->is_enabled;

        $resource->save();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }

    public function downloadResource(Request $request, $id)
    {
        $resource = Resource::query()->findOrFail($id);

        if (! $resource->is_enabled) {
            return response();
        }

        return response()->download($resource->full_file_path);
    }
}
