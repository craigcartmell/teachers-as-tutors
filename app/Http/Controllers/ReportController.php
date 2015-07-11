<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Request;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Report;
use TeachersAsTutors\User;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::query()->where('created_by', auth()->user()->getKey())->get();

        return view('reports.index', ['reports' => $reports]);
    }

    public function getEdit(Request $request, $id = 0)
    {
        $report = new Report();

        if ($id) {
            $report = Report::query()->findOrFail($id);
        }

        $parents = User::query()->where('permission_id', 3)->get();

        return view('reports.edit', ['report' => $report, 'parents' => $parents]);
    }

    public function postEdit(Request $request, $id = 0)
    {
        $report = new Report();

        if ($id) {
            $report = Report::query()->findOrFail($id);
        }

        $this->validate($request, ['name' => 'required|max:255', 'report' => 'required']);

        $report->parent_id  = $request->input('parent_id') ?: null;
        $report->name       = $request->input('name');
        $report->report     = $request->input('report');
        $report->is_enabled = $request->input('is_enabled');

        $report->save();

        if (empty($id)) {
            return redirect()->route('reports.edit', ['id' => $report->getKey()])->with([
                'success' => true,
            ]);
        }

        return redirect()->back()->with('success', true);
    }

    public function delete(Request $request, $id)
    {
        $report = Report::query()->findOrFail($id);

        $report->delete();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }

    public function enable(Request $request, $id)
    {
        $report = Report::query()->findOrFail($id);

        $report->is_enabled = ! $report->is_enabled;

        $report->save();

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back();
    }
}
