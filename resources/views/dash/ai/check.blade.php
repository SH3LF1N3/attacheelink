@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include('dash.parts.topnav')
    @include('dash.parts.sidenav')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">AI Resume Checker</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">AI Tools</li>
                            <li class="breadcrumb-item active">Resume Checker</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-3">

                    {{-- Input panel --}}
                    <div class="col-lg-5">
                        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;overflow:hidden;">
                            <div class="card-header py-3 px-4"
                                 style="background:var(--navy-700);border:none;">
                                <h6 class="mb-0 text-white fw-bold">
                                    <i class="bi bi-file-earmark-person me-2"></i>Your CV
                                </h6>
                            </div>
                            <div class="card-body px-4 py-4">
                                <form id="cv-form">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="font-size:.875rem;">
                                            Target Opportunity
                                            <span style="color:#9ca3af;font-weight:400;">(optional)</span>
                                        </label>
                                        <select name="oppo_id" id="oppo_id" class="form-select"
                                                style="border-radius:8px;font-size:.875rem;">
                                            <option value="">— General review —</option>
                                            @foreach($openOppo as $o)
                                            <option value="{{ $o->id }}">{{ $o->oname }} · {{ $o->org }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="font-size:.875rem;">
                                            Paste CV Text
                                        </label>
                                        <textarea name="cv_text" id="cv_text" rows="10"
                                                  class="form-control" style="border-radius:8px;font-size:.8rem;"
                                                  placeholder="Paste your CV content here…"></textarea>
                                    </div>

                                    <div class="mb-4" style="text-align:center;color:#9ca3af;font-size:.8rem;">
                                        — or —
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold" style="font-size:.875rem;">
                                            Upload CV File
                                            <span style="color:#9ca3af;font-weight:400;">(txt or pdf)</span>
                                        </label>
                                        <input type="file" name="cv_file" id="cv_file"
                                               accept=".txt,.pdf" class="form-control"
                                               style="border-radius:8px;">
                                    </div>

                                    <button type="submit" id="check-btn" class="btn w-100"
                                            style="background:var(--navy-700);color:#fff;border-radius:8px;font-weight:600;">
                                        <i class="bi bi-magic me-1"></i>Analyse CV
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Feedback panel --}}
                    <div class="col-lg-7">
                        <div class="card shadow-sm h-100" style="border:none;border-radius:12px;overflow:hidden;">
                            <div class="card-header py-3 px-4 bg-white"
                                 style="border-bottom:1px solid #f3f4f6;">
                                <h6 class="mb-0 fw-bold" style="color:var(--navy-800);">
                                    <i class="bi bi-stars me-2" style="color:var(--navy-700);"></i>
                                    AI Feedback
                                </h6>
                            </div>
                            <div class="card-body px-4 py-4">

                                <div id="feedback-placeholder" class="text-center py-5 text-muted">
                                    <i class="bi bi-file-earmark-text" style="font-size:3rem;opacity:.25;"></i>
                                    <p class="mt-3 mb-0 small">
                                        Paste or upload your CV on the left, then click Analyse.
                                    </p>
                                </div>

                                <div id="feedback-loading" class="text-center py-5 d-none">
                                    <div class="spinner-border" style="color:var(--navy-700);"></div>
                                    <p class="mt-3 text-muted small">Analysing your CV…</p>
                                </div>

                                  <div id="feedback-result" class="d-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    @include('dash.parts.footer')
</div>

<script>
function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/\"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

function parseFeedbackSections(rawText) {
    const sections = {
        score: '',
        strengths: [],
        weaknesses: [],
        recommendations: [],
        keywords: [],
        raw: rawText,
    };

    const text = String(rawText || '');
    
    // More lenient section detection
    const sectionPatterns = {
        score: /overall\s+score\s*:\s*(\d+)/i,
        strengths: /strengths\s*:\s*/i,
        weaknesses: /weaknesses\s*:\s*/i,
        recommendations: /recommendations\s*:\s*/i,
        keywords: /(ats\s+)?keywords\s*:\s*/i,
    };

    // Extract score using regex
    const scoreMatch = text.match(sectionPatterns.score);
    if (scoreMatch) {
        sections.score = scoreMatch[1];
    }

    // Helper to extract content between two markers
    const extractBetween = (startPattern, endPattern) => {
        const startMatch = text.match(startPattern);
        if (!startMatch) return '';
        
        const startIndex = text.indexOf(startMatch[0]) + startMatch[0].length;
        let endIndex = text.length;
        
        if (endPattern) {
            const endMatch = text.substring(startIndex).match(endPattern);
            if (endMatch) {
                endIndex = startIndex + text.substring(startIndex).indexOf(endMatch[0]);
            }
        }
        
        return text.substring(startIndex, endIndex).trim();
    };

    // Extract each section
    const strengthsRaw = extractBetween(sectionPatterns.strengths, sectionPatterns.weaknesses);
    const weaknessesRaw = extractBetween(sectionPatterns.weaknesses, sectionPatterns.recommendations);
    const recommendationsRaw = extractBetween(sectionPatterns.recommendations, sectionPatterns.keywords);
    const keywordsRaw = extractBetween(sectionPatterns.keywords, null);

    const parseBulletPoints = (text) => {
        return text
            .split('\n')
            .map(line => line.trim())
            .filter(line => /^[-*•]/.test(line) || /^\d+[.)]\s/.test(line))
            .map(line => line.replace(/^[-*•\d.)\s]+/, '').trim())
            .filter(line => line.length > 0);
    };

    sections.strengths = parseBulletPoints(strengthsRaw);
    sections.weaknesses = parseBulletPoints(weaknessesRaw);
    sections.recommendations = parseBulletPoints(recommendationsRaw);
    sections.keywords = parseBulletPoints(keywordsRaw);

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

    if (scoreValue >= 85) return { color: '#059669', band: 'Excellent' };
    if (scoreValue >= 70) return { color: '#0284c7', band: 'Strong' };
    if (scoreValue >= 55) return { color: '#b45309', band: 'Fair' };
    return { color: '#b91c1c', band: 'Needs Work' };
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

function renderFeedback(rawText) {
    const parsed = parseFeedbackSections(rawText);
    const score = parsed.score || 'Not provided';

    const sectionCard = (title, icon, body, accent) => {
        return '<div class="card mb-3" style="border:1px solid #eef2f7;border-radius:10px;box-shadow:none;">'
            + '<div class="card-header bg-white" style="border-bottom:1px solid #f3f4f6;padding:.75rem 1rem;">'
            + '<div style="display:flex;align-items:center;gap:.5rem;font-size:.86rem;font-weight:700;color:' + accent + ';">'
            + '<i class="bi ' + icon + '"></i><span>' + escapeHtml(title) + '</span></div></div>'
            + '<div class="card-body" style="padding:.85rem 1rem;">' + body + '</div></div>';
    };

    const keywords = parsed.keywords.length
        ? parsed.keywords.map((word) => '<span class="badge" style="background:#eaf2ff;color:#1d4ed8;border-radius:999px;padding:.4rem .65rem;margin:0 .35rem .35rem 0;font-weight:500;">' + escapeHtml(word) + '</span>').join('')
        : '<div style="font-size:.82rem;color:#9ca3af;">No ATS keywords were provided.</div>';

    // Check if we have essential sections
    const hasScore = !!parsed.score;
    const hasStrengths = parsed.strengths.length > 0;
    const hasWeaknesses = parsed.weaknesses.length > 0;
    const hasRecommendations = parsed.recommendations.length > 0;
    const hasKeywords = parsed.keywords.length > 0;
    
    const allSectionsPresent = hasScore && hasStrengths && hasWeaknesses && hasRecommendations && hasKeywords;

    // If critical sections are completely missing, show raw feedback with warning
    if (!hasWeaknesses || !hasRecommendations) {
        let html = '<div style="background:#fef3c7;border:1px solid #fcd34d;border-radius:8px;padding:1rem;margin-bottom:1.5rem;">'
            + '<div style="display:flex;gap:0.75rem;font-size:.875rem;color:#92400e;">'
            + '<i class="bi bi-info-circle" style="font-size:1rem;flex-shrink:0;margin-top:.1rem;"></i>'
            + '<div>'
            + '<strong>Incomplete Analysis:</strong> The AI is having difficulty generating all sections. '
            + 'Please try again, or try a shorter/clearer CV text for more detailed feedback.'
            + '</div></div></div>';
        
        html += scoreRingHtml(score, 'Overall Score');
        html += sectionCard('Strengths', 'bi-check-circle-fill', listHtml(parsed.strengths, 'No strengths identified.'), '#065f46');
        html += sectionCard('Raw Feedback', 'bi-text-left', '<div style="white-space:pre-wrap;font-size:.82rem;color:#374151;line-height:1.6;">' + escapeHtml(parsed.raw) + '</div>', '#64748b');
        
        return html;
    }

    return ''
        + scoreRingHtml(score, 'Overall Score')
        + sectionCard('Strengths', 'bi-check-circle-fill', listHtml(parsed.strengths, 'No strengths section found.'), '#065f46')
        + sectionCard('Weaknesses', 'bi-exclamation-circle-fill', listHtml(parsed.weaknesses, 'No weaknesses section found.'), '#991b1b')
        + sectionCard('Recommendations', 'bi-lightbulb-fill', listHtml(parsed.recommendations, 'No recommendations section found.'), '#1d4ed8')
        + sectionCard('ATS Keywords', 'bi-tags-fill', '<div style="display:flex;flex-wrap:wrap;">' + keywords + '</div>', '#7c3aed');
}

document.getElementById('cv-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    document.getElementById('feedback-placeholder').classList.add('d-none');
    document.getElementById('feedback-result').classList.add('d-none');
    document.getElementById('feedback-loading').classList.remove('d-none');
    document.getElementById('check-btn').disabled = true;

    const formData = new FormData(this);

    try {
        const res  = await fetch('{{ route("ai.resume.check") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: formData,
        });
        const data = await res.json();

        if (data.error) {
            alert(data.error);
        } else {
            document.getElementById('feedback-result').innerHTML = renderFeedback(data.feedback);
            document.getElementById('feedback-result').classList.remove('d-none');

            document.getElementById('cv_text').value = '';
            document.getElementById('cv_file').value = '';
        }
    } catch {
        alert('An error occurred. Please try again.');
    } finally {
        document.getElementById('feedback-loading').classList.add('d-none');
        document.getElementById('check-btn').disabled = false;
    }
});
</script>