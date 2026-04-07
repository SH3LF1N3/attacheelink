<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Interview Scheduled</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Helvetica Neue',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#fff;border-radius:12px;overflow:hidden;
                          box-shadow:0 2px 16px rgba(0,0,0,.08);">

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
                    <td style="background:#0f766e;padding:14px 40px;text-align:center;">
                        <span style="color:#fff;font-size:14px;font-weight:700;
                                     text-transform:uppercase;letter-spacing:0.08em;">
                            Interview Scheduled 📅
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
                            Great! Your interview has been scheduled with <strong>{{ $orgName }}</strong>. 
                            Here are the details:
                        </p>

                        {{-- Interview details --}}
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background:#F8F9FB;border:1.5px solid #E8EDF3;
                                      border-radius:8px;margin-bottom:24px;">
                            <tr>
                                <td style="padding:24px;">
                                    {{-- Position --}}
                                    <div style="margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid #E2E8F0;">
                                        <p style="margin:0;font-size:12px;color:#6b7280;font-weight:600;
                                                  text-transform:uppercase;letter-spacing:0.5px;">
                                            Position
                                        </p>
                                        <p style="margin:6px 0 0;font-size:15px;color:#12243B;font-weight:600;">
                                            {{ $opportunityTitle }}
                                        </p>
                                    </div>

                                    {{-- Date & Time --}}
                                    <div style="margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid #E2E8F0;">
                                        <p style="margin:0;font-size:12px;color:#6b7280;font-weight:600;
                                                  text-transform:uppercase;letter-spacing:0.5px;">
                                            📅 Date & Time
                                        </p>
                                        <p style="margin:6px 0 0;font-size:15px;color:#12243B;font-weight:600;">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $interviewDate)->format('l, F j, Y') }} 
                                            at {{ $interviewTime }}
                                        </p>
                                    </div>

                                    {{-- Interview Type --}}
                                    <div style="margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid #E2E8F0;">
                                        <p style="margin:0;font-size:12px;color:#6b7280;font-weight:600;
                                                  text-transform:uppercase;letter-spacing:0.5px;">
                                            Interview Type
                                        </p>
                                        <p style="margin:6px 0 0;font-size:15px;color:#12243B;font-weight:600;">
                                            {{ ucfirst($interviewType) }} 
                                            @if($interviewType === 'physical')
                                                📍
                                            @else
                                                💻
                                            @endif
                                        </p>
                                    </div>

                                    {{-- Location or Link --}}
                                    @if($interviewType === 'physical' && $locationOrLink)
                                    <div style="margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid #E2E8F0;">
                                        <p style="margin:0;font-size:12px;color:#6b7280;font-weight:600;
                                                  text-transform:uppercase;letter-spacing:0.5px;">
                                            Location
                                        </p>
                                        <p style="margin:6px 0 0;font-size:15px;color:#12243B;font-weight:600;">
                                            {{ $locationOrLink }}
                                        </p>
                                    </div>
                                    @elseif($interviewType === 'online' && $locationOrLink)
                                    <div style="margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid #E2E8F0;">
                                        <p style="margin:0;font-size:12px;color:#6b7280;font-weight:600;
                                                  text-transform:uppercase;letter-spacing:0.5px;">
                                            Meeting Link
                                        </p>
                                        <p style="margin:6px 0 0;">
                                            <a href="{{ $locationOrLink }}" 
                                               style="color:#0f766e;font-weight:600;text-decoration:none;word-break:break-all;">
                                                {{ $locationOrLink }}
                                            </a>
                                        </p>
                                    </div>
                                    @endif

                                    {{-- Notes --}}
                                    @if($notes)
                                    <div>
                                        <p style="margin:0;font-size:12px;color:#6b7280;font-weight:600;
                                                  text-transform:uppercase;letter-spacing:0.5px;">
                                            Additional Notes
                                        </p>
                                        <p style="margin:6px 0 0;font-size:14px;color:#374151;line-height:1.6;">
                                            {{ $notes }}
                                        </p>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        {{-- CTA --}}
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <a href="{{ config('app.url') }}/dashboard" 
                                       style="display:inline-block;background:#0f766e;
                                              color:#fff;text-decoration:none;
                                              font-size:15px;font-weight:700;
                                              padding:12px 28px;border-radius:6px;">
                                        Go to Dashboard
                                    </a>
                                </td>
                            </tr>
                        </table>

                        {{-- Footer message --}}
                        <p style="margin:32px 0 0;font-size:13px;color:#6b7280;line-height:1.6;text-align:center;">
                            Please ensure you have the necessary materials ready for your interview.
                            If you have any questions, feel free to reply to this email.
                        </p>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="background:#F9FAFB;padding:24px 40px;text-align:center;
                               border-top:1px solid #E8EDF3;">
                        <p style="margin:0;font-size:12px;color:#6b7280;line-height:1.6;">
                            © 2026 AttachKE — Connecting Kenyan Students to Meaningful Attachments<br>
                            <a href="{{ config('app.url') }}/contactus" 
                               style="color:#0f766e;text-decoration:none;font-weight:600;">
                                Contact Us
                            </a> • 
                            <a href="{{ config('app.url') }}/aboutus"
                               style="color:#0f766e;text-decoration:none;font-weight:600;">
                                About Us
                            </a>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
