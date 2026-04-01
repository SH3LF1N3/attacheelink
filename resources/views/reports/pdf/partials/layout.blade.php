<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; font-size: 12px; color: #12243B; line-height: 1.5; }
        .header { background: #182F4D; color: #fff; padding: 20px 30px; margin-bottom: 20px; }
        .header h1 { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
        .header p  { font-size: 10px; color: #9ca3af; }
        .accent    { color: #D4A843; }
        .section   { padding: 0 30px 20px; }
        .section-title { font-size: 13px; font-weight: 700; color: #182F4D;
                         border-bottom: 2px solid #e8edf3; padding-bottom: 6px; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th    { background: #f9fafb; color: #6b7280; font-weight: 600;
                padding: 8px 10px; text-align: left; border-bottom: 1px solid #e8edf3; }
        td    { padding: 7px 10px; border-bottom: 1px solid #f3f4f6; }
        tr:nth-child(even) td { background: #fafafa; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 4px;
                 font-size: 10px; font-weight: 600; }
        .badge-green  { background: #d1fae5; color: #065f46; }
        .badge-amber  { background: #fef9ec; color: #b45309; }
        .badge-blue   { background: #dbeafe; color: #1d4ed8; }
        .badge-red    { background: #fee2e2; color: #991b1b; }
        .badge-gray   { background: #f3f4f6; color: #6b7280; }
        .badge-navy   { background: #e8edf3; color: #182F4D; }
        .stat-row { display: flex; gap: 20px; margin-bottom: 16px; }
        .stat-box { flex: 1; background: #f9fafb; border: 1px solid #e8edf3;
                    border-radius: 6px; padding: 12px; text-align: center; }
        .stat-val { font-size: 20px; font-weight: 700; color: #182F4D; }
        .stat-lbl { font-size: 10px; color: #6b7280; margin-top: 2px; }
        .footer   { position: fixed; bottom: 0; left: 0; right: 0;
                    border-top: 1px solid #e8edf3; padding: 8px 30px;
                    font-size: 10px; color: #9ca3af; display: flex;
                    justify-content: space-between; }
    </style>
</head>
<body>
    <div class="header">
        <h1><span class="accent">Attach</span>KE &mdash; {{ $title ?? 'Report' }}</h1>
        <p>Generated: {{ $generated_at }} &bull; {{ $app_name }}</p>
    </div>
    {{ $slot }}
    <div class="footer">
        <span>{{ $app_name }} &copy; {{ date('Y') }}</span>
        <span>Confidential &mdash; For internal use only</span>
    </div>
</body>
</html>