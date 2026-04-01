@php $title = 'Applications Report'; @endphp
<x-reports.pdf.partials.layout :title="$title" :generated_at="$generated_at" :app_name="$app_name">

<div class="section">
    <div class="section-title">Applications by Opportunity (Ranked)</div>
    <table>
        <thead>
            <tr>
                <th>Rank</th><th>Opportunity</th><th>Organisation</th>
                <th>Total</th><th>Pending</th><th>Review</th><th>Shortlisted</th><th>Rejected</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appsByOrg as $i => $row)
            <tr>
                <td>#{{ $i + 1 }}</td>
                <td>{{ $row['oname'] }}</td>
                <td>{{ $row['org'] }}</td>
                <td><span class="badge badge-navy">{{ $row['total'] }}</span></td>
                <td><span class="badge badge-amber">{{ $row['pending'] }}</span></td>
                <td><span class="badge badge-blue">{{ $row['review'] }}</span></td>
                <td><span class="badge badge-green">{{ $row['shortlisted'] }}</span></td>
                <td><span class="badge badge-red">{{ $row['rejected'] }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-reports.pdf.partials.layout>