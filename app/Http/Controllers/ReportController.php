<?php

namespace TeachersAsTutors\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Report;
use TeachersAsTutors\User;

class ReportController extends Controller
{
    public function index()
    {
        $field = auth()->user()->is_parent ? 'parent_id' : 'created_by';

        $reports = Report::query()->where($field, auth()->user()->getKey());

        if (auth()->user()->is_parent) {
            $reports = $reports->where('is_enabled', true);
        }

        return view('reports.index', ['reports' => $reports->get(),]);
    }

    public function getEdit(Request $request, $id = 0)
    {
        $report       = new Report();
        $report->name = 'New Report';

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
        $report->is_enabled = $request->input('is_enabled', false);

        if (! $report->exists) {
            $report->slug = Carbon::now()->format('Y-m-d') . '-' . str_slug($report->name);
        }

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

    public function getBySlug($slug)
    {
        $report = Report::query()->where('slug', $slug)->firstOrFail();

        if (! $report->is_enabled) {
            abort(404);
        }

        if (auth()->user()->getKey() !== $report->created_by && auth()->user()->getKey() !== $report->parent_id) {
            abort(401);
        }

        return view('reports.report', ['report' => $report]);
    }

    public function notify(Request $request, Mailer $mailer, $id)
    {
        $report = Report::query()->with('parent')->findOrFail($id);

        $mailer->send('emails.notification', ['report' => $report], function ($m) use ($report) {
            $m->to($report->parent->email,
                $report->parent->name)->subject($report->creator->name . ' has sent a notification regarding ' . $report->name . '.');
        });

        if ($request->ajax()) {
            return response();
        }

        return redirect()->back()->with('notification_sent',
            'A notification email has been sent to ' . $report->parent->email);
    }

    public function getOther()
    {
        $reports = Report::query()->whereNull('created_by')->orWhere('created_by', '!=', auth()->user()->getKey())->get();

        return view('reports.other', ['reports' => $reports,]);
    }
}
