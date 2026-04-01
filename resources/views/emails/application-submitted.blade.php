<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Application Received</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Helvetica Neue',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#fff;border-radius:12px;overflow:hidden;
                          box-shadow:0 2px 16px rgba(0,0,0,.08);">

                {{-- Header --}}
                <tr>
                    <td style="background:#182F4D;padding:32px 40px;text-align:center;">
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

                {{-- Body --}}
                <tr>
                    <td style="padding:36px 40px;">
                        <p style="margin:0 0 8px;font-size:13px;color:#9ca3af;
                                  text-transform:uppercase;letter-spacing:0.06em;font-weight:600;">
                            New Application
                        </p>
                        <h2 style="margin:0 0 20px;font-size:20px;color:#12243B;font-weight:700;">
                            Hello {{ $orgName }},
                        </h2>
                        <p style="margin:0 0 24px;font-size:15px;color:#374151;line-height:1.65;">
                            You have received a new attachment application on AttachKE.
                        </p>

                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background:#F8F9FB;border:1.5px solid #E8EDF3;
                                      border-radius:8px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:22px 26px;">
                                    <p style="margin:0 0 10px;font-size:14px;color:#6b7280;">
                                        <strong style="color:#12243B;display:inline-block;width:130px;">
                                            Applicant
                                        </strong>{{ $studentName }}
                                    </p>
                                    <p style="margin:0 0 10px;font-size:14px;color:#6b7280;">
                                        <strong style="color:#12243B;display:inline-block;width:130px;">
                                            Position
                                        </strong>{{ $opportunityTitle }}
                                    </p>
                                    <p style="margin:0;font-size:14px;color:#6b7280;">
                                        <strong style="color:#12243B;display:inline-block;width:130px;">
                                            Date Applied
                                        </strong>{{ $applicationDate }}
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="background:#182F4D;border-radius:8px;">
                                    <a href="{{ url('/applications') }}"
                                       style="display:inline-block;padding:13px 32px;color:#fff;
                                              font-size:15px;font-weight:600;text-decoration:none;">
                                        Review Application →
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