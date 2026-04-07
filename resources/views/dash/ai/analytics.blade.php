@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">AI Analytics</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">AI Tools</li>
                            <li class="breadcrumb-item active">AI Analytics</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                {{-- Stat cards --}}
                <div class="row g-3 mb-4">
                    @php
                    $statCards = [
                        ['Students',      $data['total_students'], 'bi-people-fill',             'var(--navy-700)'],
                        ['Organisations', $data['total_orgs'],     'bi-building-fill',            '#b45309'],
                        ['Opportunities', $data['total_oppo'],     'bi-list-task',                '#0f766e'],
                        ['Applications',  $data['total_apps'],     'bi-file-earmark-text-fill',   '#7c3aed'],
                    ];
                    @endphp
                    @foreach($statCards as [$label, $val, $icon, $color])
                    <div class="col-6 col-md-3">
                        <div class="card shadow-sm" style="border:none;border-radius:12px;">
                            <div class="card-body p-3">
                                <div style="width:38px;height:38px;border-radius:10px;margin-bottom:8px;
                                            background:{{ $color }}20;
                                            display:flex;align-items:center;justify-content:center;">
                                    <i class="bi {{ $icon }}" style="color:{{ $color }};font-size:1rem;"></i>
                                </div>
                                <div style="font-size:1.8rem;font-weight:700;color:var(--navy-800);line-height:1;">
                                    {{ $val }}
                                </div>
                                <div style="font-size:.75rem;color:#6b7280;margin-top:4px;">{{ $label }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row g-3 mb-4">

                    {{-- Application status breakdown --}}
                    <div class="col-lg-5">
                        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
                            <div class="card-header bg-white px-4 py-3"
                                 style="border-bottom:1px solid #f3f4f6;">
                                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                                    Application Status Breakdown
                                </h6>
                            </div>
                            <div class="card-body px-4 py-4">
                                @php
                                $statuses = [
                                    ['Pending',          $data['by_status']['pending'],             '#fef9ec', '#b45309'],
                                    ['Under Review',     $data['by_status']['review'],              '#dbeafe', '#1d4ed8'],
                                    ['Shortlisted',      $data['by_status']['shortlisted'],         '#d1fae5', '#065f46'],
                                    ['Interviewed',      $data['by_status']['interview_scheduled'], '#f3e8ff', '#7c3aed'],
                                    ['Selected',         $data['by_status']['selected'],            '#d1fae5', '#059669'],
                                    ['Rejected',         $data['by_status']['rejected'],            '#fee2e2', '#991b1b'],
                                ];
                                $total = max($data['total_apps'], 1);
                                @endphp
                                @foreach($statuses as [$label, $count, $bg, $color])
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="font-size:.8125rem;font-weight:600;color:{{ $color }};">
                                            {{ $label }}
                                        </span>
                                        <span style="font-size:.8125rem;color:#6b7280;">
                                            {{ $count }} ({{ $total > 0 ? round(($count/$total)*100) : 0 }}%)
                                        </span>
                                    </div>
                                    <div style="height:8px;background:#f3f4f6;border-radius:999px;">
                                        <div style="height:100%;width:{{ $total > 0 ? ($count/$total)*100 : 0 }}%;
                                                    background:{{ $color }};border-radius:999px;transition:.3s;">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Top orgs + top opportunities --}}
                    <div class="col-lg-7">
                        <div class="row g-3 h-100">

                            <div class="col-md-6">
                                <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
                                    <div class="card-header bg-white px-4 py-3"
                                         style="border-bottom:1px solid #f3f4f6;">
                                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);font-size:.875rem;">
                                            Top Organisations by Applications
                                        </h6>
                                    </div>
                                    <div class="card-body p-0">
                                        @forelse($data['top_orgs'] as $org => $count)
                                        <div class="d-flex align-items-center justify-content-between px-4 py-2"
                                             style="border-bottom:1px solid #f9fafb;">
                                            <span style="font-size:.8125rem;color:var(--navy-800);font-weight:600;">
                                                {{ $org }}
                                            </span>
                                            <span class="badge"
                                                  style="background:#fef9ec;color:#b45309;font-size:.72rem;border-radius:6px;">
                                                {{ $count }}
                                            </span>
                                        </div>
                                        @empty
                                        <div class="text-center py-4 text-muted small">No data yet.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card shadow-sm h-100" style="border:none;border-radius:12px;">
                                    <div class="card-header bg-white px-4 py-3"
                                         style="border-bottom:1px solid #f3f4f6;">
                                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);font-size:.875rem;">
                                            Most Applied Opportunities
                                        </h6>
                                    </div>
                                    <div class="card-body p-0">
                                        @forelse($data['top_oppo'] as $oppo)
                                        <div class="d-flex align-items-center justify-content-between px-4 py-2"
                                             style="border-bottom:1px solid #f9fafb;">
                                            <span style="font-size:.8125rem;color:var(--navy-800);font-weight:600;
                                                         overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
                                                         max-width:130px;">
                                                {{ $oppo['name'] }}
                                            </span>
                                            <span class="badge"
                                                  style="background:#d1fae5;color:#065f46;font-size:.72rem;border-radius:6px;">
                                                {{ $oppo['count'] }}
                                            </span>
                                        </div>
                                        @empty
                                        <div class="text-center py-4 text-muted small">No data yet.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- Daily applications chart --}}
                <div class="card shadow-sm mb-4" style="border:none;border-radius:12px;">
                    <div class="card-header bg-white px-4 py-3" style="border-bottom:1px solid #f3f4f6;">
                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                            Daily Applications (Last 14 Days)
                        </h6>
                    </div>
                    <div class="card-body px-4 py-3">
                        <canvas id="dailyChart" height="80"></canvas>
                    </div>
                </div>

                {{-- Performance Metrics --}}
                <div class="row g-3 mb-4">
                    @php
                    $metrics = $data['metrics'];
                    $metricCards = [
                        ['Conversion Rate', $metrics['avg_conversion_rate'] . '%', 'bi-percent', '#059669'],
                        ['Advancement Rate', $metrics['avg_advancement_rate'] . '%', 'bi-arrow-up-right', '#0284c7'],
                        ['Rejection Rate', $metrics['avg_rejection_rate'] . '%', 'bi-x-circle', '#991b1b'],
                        ['Interview-to-Selection', $metrics['interview_to_selection'] . '%', 'bi-person-check', '#7c3aed'],
                    ];
                    @endphp
                    @foreach($metricCards as [$label, $value, $icon, $color])
                    <div class="col-6 col-md-3">
                        <div class="card shadow-sm" style="border:none;border-radius:12px;">
                            <div class="card-body p-3">
                                <div style="font-size:.75rem;color:#6b7280;margin-bottom:8px;font-weight:600;">
                                    {{ $label }}
                                </div>
                                <div style="display:flex;align-items:baseline;gap:.5rem;">
                                    <div style="font-size:1.5rem;font-weight:700;color:{{ $color }};line-height:1;">
                                        {{ $value }}
                                    </div>
                                </div>
                                <div style="margin-top:8px;height:4px;background:#f3f4f6;border-radius:999px;overflow:hidden;">
                                    <div style="height:100%;width:{{ str_replace('%', '', $value) }}%;background:{{ $color }};border-radius:999px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Organization Status Breakdown --}}
                <div class="card shadow-sm mb-4" style="border:none;border-radius:12px;">
                    <div class="card-header bg-white px-4 py-3" style="border-bottom:1px solid #f3f4f6;">
                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                            Status Breakdown by Organization
                        </h6>
                    </div>
                    <div class="card-body px-4 py-3">
                        @if(count($data['org_status_breakdown']) > 0)
                        <div style="overflow-x:auto;">
                            <table style="width:100%;border-collapse:collapse;font-size:.8125rem;">
                                <thead style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">
                                    <tr>
                                        <th style="padding:.75rem;text-align:left;font-weight:700;color:var(--navy-800);">Organization</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#b45309;">Pending</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#1d4ed8;">Under Review</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#065f46;">Shortlisted</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#7c3aed;">Interviewed</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#059669;">Selected</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#991b1b;">Rejected</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:var(--navy-800);">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['org_status_breakdown'] as $org => $breakdown)
                                    <tr style="border-bottom:1px solid #f3f4f6;hover:{background:#fafbfc;}">
                                        <td style="padding:.75rem;color:var(--navy-800);font-weight:600;">{{ $org }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#b45309;">{{ $breakdown['pending'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#1d4ed8;">{{ $breakdown['review'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#065f46;">{{ $breakdown['shortlisted'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#7c3aed;">{{ $breakdown['interview_scheduled'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#059669;">{{ $breakdown['selected'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#991b1b;">{{ $breakdown['rejected'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:var(--navy-800);font-weight:700;">{{ $breakdown['total'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4 text-muted small">No organization data available.</div>
                        @endif
                    </div>
                </div>

                {{-- Opportunity Status Breakdown --}}
                <div class="card shadow-sm mb-4" style="border:none;border-radius:12px;">
                    <div class="card-header bg-white px-4 py-3" style="border-bottom:1px solid #f3f4f6;">
                        <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                            Status Breakdown by Opportunity
                        </h6>
                    </div>
                    <div class="card-body px-4 py-3">
                        @if(count($data['oppo_status_breakdown']) > 0)
                        <div style="overflow-x:auto;">
                            <table style="width:100%;border-collapse:collapse;font-size:.8125rem;">
                                <thead style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">
                                    <tr>
                                        <th style="padding:.75rem;text-align:left;font-weight:700;color:var(--navy-800);">Opportunity</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#b45309;">Pending</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#1d4ed8;">Under Review</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#065f46;">Shortlisted</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#7c3aed;">Interviewed</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#059669;">Selected</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:#991b1b;">Rejected</th>
                                        <th style="padding:.75rem;text-align:center;font-weight:700;color:var(--navy-800);">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['oppo_status_breakdown'] as $oppo => $breakdown)
                                    <tr style="border-bottom:1px solid #f3f4f6;">
                                        <td style="padding:.75rem;color:var(--navy-800);font-weight:600;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $oppo }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#b45309;">{{ $breakdown['pending'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#1d4ed8;">{{ $breakdown['review'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#065f46;">{{ $breakdown['shortlisted'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#7c3aed;">{{ $breakdown['interview_scheduled'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#059669;">{{ $breakdown['selected'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:#991b1b;">{{ $breakdown['rejected'] }}</td>
                                        <td style="padding:.75rem;text-align:center;color:var(--navy-800);font-weight:700;">{{ $breakdown['total'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4 text-muted small">No opportunity data available.</div>
                        @endif
                    </div>
                </div>

                {{-- Ask AI --}}
                <div class="card shadow-sm" style="border:none;border-radius:12px;overflow:hidden;">
                    <div class="card-header py-3 px-4"
                         style="background:var(--navy-700);border:none;">
                        <h6 class="mb-0 text-white fw-bold">
                            <i class="bi bi-stars me-2"></i>Ask AI About This Data
                        </h6>
                    </div>
                    <div class="card-body px-4 py-4">
                        <form id="insight-form" class="d-flex gap-2 mb-3">
                            @csrf
                            <input type="text" id="insight-input" name="question"
                                   class="form-control" style="border-radius:8px;"
                                   placeholder="e.g. Which organisations have the lowest shortlist rate?"
                                   required>
                            <button type="submit" id="insight-btn" class="btn"
                                    style="background:var(--navy-700);color:#fff;border-radius:8px;white-space:nowrap;">
                                <span id="insight-label"><i class="bi bi-send-fill"></i> Ask</span>
                                <span id="insight-spinner" class="spinner-border spinner-border-sm d-none"></span>
                            </button>
                        </form>
                        <div id="insight-result" class="d-none"></div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Daily applications chart
const dailyData = @json($data['daily_apps']);
const labels    = Object.keys(dailyData);
const values    = Object.values(dailyData);

new Chart(document.getElementById('dailyChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Applications',
            data: values,
            backgroundColor: 'rgba(24,47,77,0.75)',
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } },
            x: { grid: { display: false } },
        }
    }
});

// Ask AI
function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/\"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

function parseInsightSections(rawText) {
    const sections = {
        score: '',
        findings: [],
        risks: [],
        actions: [],
        raw: rawText,
    };

    const rawLines = String(rawText || '').split(/\r?\n/);
    const lines = [];
    
    // Keep lines but track structure
    for (const line of rawLines) {
        const trimmed = line.trim();
        if (trimmed) {
            lines.push(trimmed);
        }
    }

    let current = '';

    const detectHeading = (line) => {
        const clean = line.toLowerCase();
        if (clean.includes('insight score')) return 'score';
        if (clean.includes('key findings')) return 'findings';
        if (clean.includes('risks and gaps') || clean.includes('risks')) return 'risks';
        if (clean.includes('recommended actions') || clean.includes('actions')) return 'actions';
        return '';
    };

    const stripBullet = (text) => {
        // Remove leading bullet characters and whitespace more aggressively
        let result = text;
        // Remove leading - * • characters with optional dots/parens
        result = result.replace(/^[\s\-\*•]+/g, '');
        // Remove leading numbers followed by . or )
        result = result.replace(/^\d+[.)]\s*/g, '');
        // Final trim
        return result.trim();
    };

    for (const line of lines) {
        const heading = detectHeading(line);
        
        if (heading) {
            current = heading;
            // Extract inline content after colon
            const colonIdx = line.indexOf(':');
            if (colonIdx !== -1) {
                const afterColon = line.substring(colonIdx + 1).trim();
                if (afterColon && heading === 'score') {
                    sections.score = afterColon;
                } else if (afterColon && heading !== 'score') {
                    const cleaned = stripBullet(afterColon);
                    if (cleaned && cleaned.length > 3) {
                        sections[current].push(cleaned);
                    }
                }
            }
            continue;
        }

        if (!current) {
            continue;
        }

        // Process content under current section
        if (current === 'score') {
            if (!sections.score && line && !detectHeading(line)) {
                sections.score = line;
            }
        } else {
            // For findings, risks, actions - extract bullet content
            const text = line.trim();
            if (text && !detectHeading(text)) {
                const cleaned = stripBullet(text);
                if (cleaned && cleaned.length > 3) {
                    sections[current].push(cleaned);
                }
            }
        }
    }

    // Trim empty entries but keep content even if short
    sections.findings = sections.findings.filter(s => s && s.length > 0);
    sections.risks = sections.risks.filter(s => s && s.length > 0);
    sections.actions = sections.actions.filter(s => s && s.length > 0);

    return sections;
}

function listHtml(items, emptyText) {
    if (!items.length) {
        return '<div style="font-size:.82rem;color:#9ca3af;">' + escapeHtml(emptyText) + '</div>';
    }

    return '<ul style="margin:0;padding-left:1rem;line-height:1.7;color:#374151;font-size:.86rem;">'
        + items.map((item) => '<li style="margin-bottom:.35rem;">' + escapeHtml(item) + '</li>').join('')
        + '</ul>';
}

function parseScoreValue(scoreText) {
    const match = String(scoreText || '').match(/(\d{1,3})/);
    if (!match) return null;
    const value = Number(match[1]);
    if (Number.isNaN(value)) return null;
    return Math.max(0, Math.min(100, value));
}

function scoreMeta(scoreValue) {
    if (scoreValue === null) {
        return { color: '#64748b', band: 'Unrated' };
    }

    if (scoreValue >= 85) return { color: '#059669', band: 'High Confidence' };
    if (scoreValue >= 70) return { color: '#0284c7', band: 'Good Confidence' };
    if (scoreValue >= 55) return { color: '#b45309', band: 'Moderate Confidence' };
    return { color: '#b91c1c', band: 'Low Confidence' };
}

function scoreRingHtml(scoreText, label) {
    const value = parseScoreValue(scoreText);
    const meta = scoreMeta(value);
    const progress = value === null ? 0 : value;
    const angle = Math.round((progress / 100) * 360);

    return '<div class="card mb-3" style="border:none;background:linear-gradient(135deg,#eff6ff,#f8fafc);border-radius:10px;">'
        + '<div class="card-body" style="padding:1rem 1.1rem;display:flex;gap:1rem;align-items:center;">'
        + '<div style="width:90px;height:90px;border-radius:50%;background:conic-gradient(' + meta.color + ' ' + angle + 'deg,#e5e7eb 0deg);display:flex;align-items:center;justify-content:center;">'
        + '<div style="width:70px;height:70px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;">'
        + '<div style="font-size:1.1rem;font-weight:800;color:#0f172a;line-height:1;">' + (value === null ? '--' : value) + '</div>'
        + '<div style="font-size:.63rem;color:#64748b;line-height:1;margin-top:.2rem;">/100</div>'
        + '</div></div>'
        + '<div>'
        + '<div style="font-size:.76rem;color:#64748b;letter-spacing:.02em;text-transform:uppercase;font-weight:600;">' + escapeHtml(label) + '</div>'
        + '<div style="font-size:1rem;font-weight:700;color:' + meta.color + ';margin-top:.2rem;">' + escapeHtml(meta.band) + '</div>'
        + '<div style="font-size:.82rem;color:#475569;margin-top:.25rem;">' + escapeHtml(scoreText || 'Not provided') + '</div>'
        + '</div></div></div>';
}

function renderInsight(rawText) {
    const parsed = parseInsightSections(rawText);
    const hasSections = parsed.findings.length || parsed.risks.length || parsed.actions.length || parsed.score;

    if (!hasSections) {
        return '<div style="background:#f9fafb;border:1px solid #e8edf3;border-radius:8px;padding:1rem;font-size:.875rem;color:#374151;line-height:1.7;white-space:pre-wrap;">'
            + escapeHtml(parsed.raw)
            + '</div>';
    }

    const sectionCard = (title, icon, body, accent) => {
        return '<div class="card mb-3" style="border:1px solid #eef2f7;border-radius:10px;box-shadow:none;">'
            + '<div class="card-header bg-white" style="border-bottom:1px solid #f3f4f6;padding:.75rem 1rem;">'
            + '<div style="display:flex;align-items:center;gap:.5rem;font-size:.86rem;font-weight:700;color:' + accent + ';">'
            + '<i class="bi ' + icon + '"></i><span>' + escapeHtml(title) + '</span></div></div>'
            + '<div class="card-body" style="padding:.85rem 1rem;">' + body + '</div></div>';
    };

    return ''
        + scoreRingHtml(parsed.score || 'Not provided', 'Insight Score')
        + sectionCard('Key Findings', 'bi-bar-chart-fill', listHtml(parsed.findings, 'No key findings were provided.'), '#065f46')
        + sectionCard('Risks and Gaps', 'bi-exclamation-triangle-fill', listHtml(parsed.risks, 'No risks were provided.'), '#b45309')
        + sectionCard('Recommended Actions', 'bi-lightbulb-fill', listHtml(parsed.actions, 'No recommended actions were provided.'), '#1d4ed8');
}

document.getElementById('insight-form').addEventListener('submit', async function (e) {
    e.preventDefault();
    const q = document.getElementById('insight-input').value.trim();
    if (!q) return;

    document.getElementById('insight-label').classList.add('d-none');
    document.getElementById('insight-spinner').classList.remove('d-none');
    document.getElementById('insight-btn').disabled = true;
    document.getElementById('insight-result').classList.add('d-none');

    try {
        const res  = await fetch('{{ route("ai.analytics.insight") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ question: q }),
        });
        const data = await res.json();
        console.log('AI Response:', data.insight);
        const parsed = parseInsightSections(data.insight || 'No insight generated.');
        console.log('Parsed sections:', { findings: parsed.findings.length, risks: parsed.risks.length, actions: parsed.actions.length });
        document.getElementById('insight-result').innerHTML = renderInsight(data.insight || 'No insight generated.');
        document.getElementById('insight-result').classList.remove('d-none');
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    } finally {
        document.getElementById('insight-label').classList.remove('d-none');
        document.getElementById('insight-spinner').classList.add('d-none');
        document.getElementById('insight-btn').disabled = false;
    }
});
</script>