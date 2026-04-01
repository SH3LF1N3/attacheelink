<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Update</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Helvetica Neue',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#fff;border-radius:12px;overflow:hidden;
                          box-shadow:0 2px 16px rgba(0,0,0,.08);">

                @php
                    $config = [
                        'shortlisted'  => [
                            'bg'    => '#0f766e',
                            'label' => 'Shortlisted 🎉',
                            'intro' => 'Great news! You have been <strong style="color:#0f766e;">shortlisted</strong> for this opportunity. The organisation will be in touch with next steps.',
                        ],
                        'under_review' => [
                            'bg'    => '#1d4ed8',
                            'label' => 'Under Review',
                            'intro' => 'Your application is currently <strong style="color:#1d4ed8;">under review</strong>. The organisation is assessing candidates and will update you shortly.',
                        ],
                        'rejected'     => [
                            'bg'    => '#991b1b',
                            'label' => 'Not Successful',
                            'intro' => 'Thank you for applying. After careful review, your application was <strong style="color:#991b1b;">not successful</strong> this time. Don\'t be discouraged — keep applying!',
                        ],
                    ];
                    $c = $config[(string)$status] ?? ['bg' => '#374151', 'label' => ucfirst($status), 'intro' => ''];
                @endphp

                {{-- Brand header --}}
                <tr>
                    <td style="background:#182F4D;padding:28px 40px;text-align:center;">
                        <div>
                            <div style="background:#D4A843;width:36px;height:36px;border-radius:8px;
                                        display:inline-block;vertical-align:middle;line-height:36px;
                                        text-align:center;">
                                <span style="color:#182F4D;font-size:18px;font-weight:900;">A</span>
                            </div>
                            <span style="color:#fff;font-size:22px;font-weight:700;
                                         vertical-align:middle;margin-left:10px;">AttachKE</span>
                        </div>
                    </td>
                </tr>

                {{-- Status banner --}}
                <tr>
                    <td style="background:{{ $c['bg'] }};padding:14px 40px;text-align:center;">
                        <span style="color:#fff;font-size:14px;font-weight:700;
                                     text-transform:uppercase;letter-spacing:0.08em;">
                            {{ $c['label'] }}
                        </span>
                    </td>
                </tr>

                {{-- Body --}}
                <tr>
                    <td style="padding:36px 40px;">
                        <h2 style="margin:0 0 16px;font-size:20px;color:#12243B;font-weight:700;">
                            Hello {{ $studentName }},
                        </h2>
                        <p style="margin:0 0 24px;font-size:15px;color:#374151;line-height:1.65;">
                            {!! $c['intro'] !!}
                        </p>

                        {{-- Application details --}}
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background:#F8F9FB;border:1.5px solid #E8EDF3;
                                      border-radius:8px;margin-bottom:24px;">
                            <tr>
                                <td style="padding:20px 24px;">
                                    <p style="margin:0 0 10px;font-size:14px;color:#6b7280;">
                                        <strong style="color:#12243B;display:inline-block;width:120px;">
                                            Position
                                        </strong>{{ $opportunityTitle }}
                                    </p>
                                    <p style="margin:0;font-size:14px;color:#6b7280;">
                                        <strong style="color:#12243B;display:inline-block;width:120px;">
                                            Organisation
                                        </strong>{{ $orgName }}
                                    </p>
                                </td>
                            </tr>
                        </table>

                        {{-- Optional message from organisation --}}
                        @if($message)
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background:#FFF8E1;border-left:4px solid #D4A843;
                                      border-radius:0 6px 6px 0;margin-bottom:24px;">
                            <tr>
                                <td style="padding:14px 18px;">
                                    <p style="margin:0;font-size:13px;color:#7c5c00;line-height:1.55;">
                                        <strong>Message from {{ $orgName }}:</strong><br>
                                        {{ $message }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                        @endif

                        {{-- CTA --}}
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="background:#182F4D;border-radius:8px;">
                                    <a href="{{ url('/my_applications') }}"
                                       style="display:inline-block;padding:13px 32px;color:#fff;
                                              font-size:15px;font-weight:600;text-decoration:none;">
                                        View My Applications →
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="background:#f9fafb;border-top:1px solid #e5e7eb;
                               padding:20px 40px;text-align:center;">
                        <p style="margin:0;font-size:12px;color:#9ca3af;">
                            © {{ date('Y') }} AttachKE. All rights reserved.
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>