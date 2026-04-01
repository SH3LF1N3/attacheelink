@php $title = 'Organisations Report'; @endphp
<x-reports.pdf.partials.layout :title="$title" :generated_at="$generated_at" :app_name="$app_name">

<div class="section">
    <div class="stat-row">
        <div class="stat-box"><div class="stat-val">{{ $orgs['total'] }}</div><div class="stat-lbl">Total Organisations</div></div>
    </div>

    <div class="section-title">Organisation List</div>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Organisation</th><th>Contact</th>
                <th>Industry</th><th>Location</th><th>Email</th><th>Opportunities</th><th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orgs['list'] as $i => $o)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $o->foth1 ?? $o->uname }}</td>
                <td>{{ $o->fname ?? '—' }}</td>
                <td>{{ $o->foth2 ?? '—' }}</td>
                <td>{{ $o->foth3 ?? '—' }}</td>
                <td>{{ $o->email }}</td>
                <td><span class="badge badge-amber">{{ $orgs['oppoCounts'][$o->uname] ?? 0 }}</span></td>
                <td>{{ $o->created_at?->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-reports.pdf.partials.layout>