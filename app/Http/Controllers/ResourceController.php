<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Request;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();

        return view('resources.index', ['resources' => $resources]);
    }

    public function getEditResource(Request $request, $id = 0)
    {
        $resource = new Resource();

        if ($id) {
            $resource = Resource::query()->findOrFail($id);
        }

        return view('resources.edit', ['resource' => $resource]);
    }

    public function postEditResource(Request $request, $id = 0)
    {
        $resource = new Resource();

        if ($id) {
            $resource = Resource::query()->findOrFail($id);
        }

        $this->validate($request, [
            'desc'              => 'max:255',
            'original_filename' => ! $id ? 'required|max:' . env('MAX_UPLOAD_SIZE') : '',
        ],
            ['original_filename.required' => 'Please select a file to upload.']);


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
