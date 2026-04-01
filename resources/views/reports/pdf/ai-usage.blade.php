@php $title = 'AI Tools Usage Report'; @endphp
<x-reports.pdf.partials.layout :title="$title" :generated_at="$generated_at" :app_name="$app_name">

<div class="section">
    <div class="stat-row">
        <div class="stat-box"><div class="stat-val">{{ $aiAssistant['total'] }}</div><div class="stat-lbl">AI Assistant Uses</div></div>
        <div class="stat-box"><div class="stat-val">{{ $aiResume['total'] }}</div><div class="stat-lbl">Resume Checker Uses</div></div>
        <div class="stat-box"><div class="stat-val">{{ $aiAnalytics['total'] }}</div><div class="stat-lbl">AI Analytics Uses</div></div>
    </div>

    @foreach([['AI Assistant', $aiAssistant], ['AI Resume Checker', $aiResume], ['AI Analytics', $aiAnalytics]] as [$label, $usage])
    <div class="section-title">{{ $label }} — Recent Usage</div>
    <table>
        <thead><tr><th>#</th><th>User</th><th>Role</th><th>Time</th></tr></thead>
        <tbody>
            @forelse($usage['recent'] as $i => $log)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $log->uname ?? '—' }}</td>
                <td><span class="badge badge-gray">{{ $log->role ?? '—' }}</span></td>
                <td>{{ $log->created_at?->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="4" style="color:#9ca3af;text-align:center;">No usage recorded.</td></tr>
            @endforelse
        </tbody>
    </table>
    <br>
    @endforeach
</div>

</x-reports.pdf.partials.layout>