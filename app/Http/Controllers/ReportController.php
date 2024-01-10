<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Group;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Group $group)
    {
        $user = Auth::user();
        if ($user->id != $group->user_id_creater) {
            return redirect()->back()->with('Not auth', 'not have Access');
        }

        $users = $group->users;
        $reports = $group->reports;
        $filesCount = File::where('group_id', $group->id)->count();

        return view('report.index', compact('group', 'users', 'reports', 'filesCount'));
    }

    public function downloadPdf(Group $group)
    {
        $user = Auth::user();
        if ($user->id != $group->user_id_creater) {
            return redirect()->back()->with('error', 'You do not have access to download the report.');
        }
        $reports = $group->reports;
        $pdf = PDF::loadView('report', ['reports' => $reports, 'group' => $group]);

        try {
            return $pdf->download('group_reports.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while generating the PDF.');
        }
    }

}
