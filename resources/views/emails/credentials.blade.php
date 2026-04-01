<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your AttachKE Credentials</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Helvetica Neue',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#ffffff;border-radius:12px;overflow:hidden;
                          box-shadow:0 2px 16px rgba(0,0,0,.08);">

                {{-- Header --}}
                <tr>
                    <td style="background:#182F4D;padding:32px 40px;text-align:center;">
                        <div style="display:inline-flex;align-items:center;gap:10px;">
                            <div style="background:#D4A843;width:36px;height:36px;border-radius:8px;
                                        display:inline-block;vertical-align:middle;line-height:36px;
                                        text-align:center;">
                                <span style="color:#182F4D;font-size:18px;font-weight:900;">A</span>
                            </div>
                            <span style="color:#ffffff;font-size:22px;font-weight:700;
                                         vertical-align:middle;letter-spacing:-0.3px;">AttachKE</span>
                        </div>
                        <p style="color:#9ca3af;font-size:13px;margin:10px 0 0;">
                            Kenya's University Attachment Platform
                        </p>
                    </td>
                </tr>

                {{-- Body --}}
                <tr>
                    <td style="padding:36px 40px;">
                        <p style="margin:0 0 8px;font-size:13px;color:#9ca3af;
                                  text-transform:uppercase;letter-spacing:0.06em;font-weight:600;">
                            Account Created
                        </p>
                        <h2 style="margin:0 0 20px;font-size:22px;color:#12243B;font-weight:700;">
                            Welcome to AttachKE, {{ $userName }}!
                        </h2>
                        <p style="margin:0 0 24px;font-size:15px;color:#374151;line-height:1.65;">
                            Your <strong>{{ $role }}</strong> account has been created successfully.
                            Use the credentials below to sign in and get started.
                        </p>

                        {{-- Credentials box --}}
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background:#F8F9FB;border:1.5px solid #E8EDF3;
                                      border-radius:8px;margin-bottom:24px;">
                            <tr>
                                <td style="padding:22px 26px;">
                                    <p style="margin:0 0 12px;font-size:14px;color:#6b7280;">
                                        <strong style="color:#12243B;display:inline-block;
                                                        width:90px;">Email</strong>
                                        {{ $userEmail }}
                                    </p>
                                    <p style="margin:0;font-size:14px;color:#6b7280;">
                                        <strong style="color:#12243B;display:inline-block;
                                                        width:90px;">Password</strong>
                                        <span style="font-family:monospace;font-size:15px;
                                                     background:#182F4D;color:#D4A843;
                                                     padding:4px 12px;border-radius:5px;
                                                     letter-spacing:0.05em;">{{ $plainPassword }}</span>
                                    </p>
                                </td>
                            </tr>
                        </table>

                        {{-- Disclaimer --}}
                        <table width="100%" cellpadding="0" cellspacing="0"
                               style="background:#FFF8E1;border-left:4px solid #D4A843;
                                      border-radius:0 6px 6px 0;margin-bottom:28px;">
                            <tr>
                                <td style="padding:14px 18px;">
                                    <p style="margin:0;font-size:13px;color:#7c5c00;line-height:1.55;">
                                        <strong>⚠ Important:</strong>
                                        For your security, you will be prompted to change your password
                                        on first login. These credentials expire once you sign in for
                                        the first time.
                                    </p>
                                </td>
                            </tr>
                        </table>

                        {{-- CTA --}}
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="background:#182F4D;border-radius:8px;">
                                    <a href="{{ url('/login') }}"
                                       style="display:inline-block;padding:13px 32px;color:#ffffff;
                                              font-size:15px;font-weight:600;text-decoration:none;
                                              border-radius:8px;">
                                        Sign In to AttachKE →
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
                        <p style="margin:0 0 6px;font-size:13px;color:#6b7280;">
                            If you didn't request this account, please ignore this email or
                            <a href="mailto:{{ config('mail.from.address') }}"
                               style="color:#182F4D;font-weight:600;">contact support</a>.
                        </p>
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