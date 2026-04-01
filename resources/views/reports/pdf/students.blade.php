@php $title = 'Students Report'; @endphp
<x-reports.pdf.partials.layout :title="$title" :generated_at="$generated_at" :app_name="$app_name">

<div class="section">
    <div class="stat-row">
        <div class="stat-box"><div class="stat-val">{{ $students['total'] }}</div><div class="stat-lbl">Total Students</div></div>
        <div class="stat-box"><div class="stat-val">{{ $students['with_apps'] }}</div><div class="stat-lbl">Applied</div></div>
        <div class="stat-box"><div class="stat-val">{{ $students['no_apps'] }}</div><div class="stat-lbl">Not Applied</div></div>
    </div>

    <div class="section-title">Student List</div>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Full Name</th><th>Username</th>
                <th>Student ID</th><th>Email</th><th>Gender</th><th>Applications</th><th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students['list'] as $i => $s)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $s->fname ?? '—' }}</td>
                <td>{{ $s->uname }}</td>
                <td>{{ $s->sid ?? '—' }}</td>
                <td>{{ $s->email }}</td>
                <td>{{ $s->gender ?? '—' }}</td>
                <td><span class="badge {{ $s->total_apps > 0 ? 'badge-green' : 'badge-gray' }}">{{ $s->total_apps }}</span></td>
                <td>{{ $s->created_at?->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-reports.pdf.partials.layout>