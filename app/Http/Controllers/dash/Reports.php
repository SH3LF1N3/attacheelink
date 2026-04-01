<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Logsdb;
use App\Models\Oppodb;
use App\Models\User;
use App\Services\PdfReport;
use Illuminate\Http\Request;

class Reports extends Controller
{
    public function reports()
    {
        return view('dash.reports', [
            'students'    => $this->studentStats(),
            'orgs'        => $this->orgStats(),
            'appsByOrg'   => $this->applicationsByOrg(),
            'aiAssistant' => $this->aiUsage('ai_assistant'),
            'aiResume'    => $this->aiUsage('ai_resume_checker'),
            'aiAnalytics' => $this->aiUsage('ai_analytics'),
        ]);
    }

    // ── PDF downloads ─────────────────────────────────────────────────────────

    public function downloadStudents()
    {
        return PdfReport::download(
            'reports.pdf.students',
            ['students' => $this->studentStats()],
            'students-report'
        );
    }

    public function downloadOrgs()
    {
        return PdfReport::download(
            'reports.pdf.orgs',
            ['orgs' => $this->orgStats()],
            'organisations-report'
        );
    }

    public function downloadApplications()
    {
        return PdfReport::download(
            'reports.pdf.applications',
            ['appsByOrg' => $this->applicationsByOrg()],
            'applications-report'
        );
    }

    public function downloadAiUsage()
    {
        return PdfReport::download(
            'reports.pdf.ai-usage',
            [
                'aiAssistant' => $this->aiUsage('ai_assistant'),
                'aiResume'    => $this->aiUsage('ai_resume_checker'),
                'aiAnalytics' => $this->aiUsage('ai_analytics'),
            ],
            'ai-usage-report'
        );
    }

    // Data builders 

    private function studentStats(): array
    {
        $students = User::where('role', 'student')
            ->withCount('applications as total_apps')
            ->latest()->get();

        return [
            'total'     => $students->count(),
            'with_apps' => $students->where('total_apps', '>', 0)->count(),
            'no_apps'   => $students->where('total_apps', 0)->count(),
            'list'      => $students,
        ];
    }

    private function orgStats(): array
    {
        $orgs       = User::where('role', 'company')->latest()->get();
        $oppoCounts = Oppodb::selectRaw('org, count(*) as total')
            ->groupBy('org')->pluck('total', 'org');

        return [
            'total'      => $orgs->count(),
            'list'       => $orgs,
            'oppoCounts' => $oppoCounts,
        ];
    }

    private function applicationsByOrg(): \Illuminate\Support\Collection
    {
        return Application::with('opportunity')
            ->selectRaw('oppodb_id, status, count(*) as total')
            ->groupBy('oppodb_id', 'status')
            ->get()
            ->groupBy('oppodb_id')
            ->map(function ($group) {
                $oppo = $group->first()->opportunity;
                return [
                    'org'         => $oppo->org    ?? '—',
                    'oname'       => $oppo->oname  ?? '—',
                    'total'       => $group->sum('total'),
                    'pending'     => $group->where('status', 'pending')->sum('total'),
                    'review'      => $group->where('status', 'review')->sum('total'),
                    'shortlisted' => $group->where('status', 'shortlisted')->sum('total'),
                    'rejected'    => $group->where('status', 'rejected')->sum('total'),
                ];
            })
            ->sortByDesc('total')
            ->values();
    }

    private function aiUsage(string $service): array
    {
        $logs = Logsdb::where('service', $service)->latest()->get();

        return [
            'total'   => $logs->count(),
            'by_role' => $logs->groupBy('role')->map->count(),
            'daily'   => $logs
                ->groupBy(fn($l) => optional($l->created_at)->format('Y-m-d'))
                ->map(fn($group) => $group->count())
                ->sortKeys()
                ->take(-14),
            'recent'  => $logs->take(10),
        ];
    }
}