<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Contact Message</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#333;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:24px 0;">
<tr><td align="center">
<table width="620" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:6px;overflow:hidden;border:1px solid #ddd;">

  {{-- Header --}}
  <tr>
    <td style="background:#111;padding:24px 32px;">
      <h1 style="margin:0;color:#fff;font-size:22px;font-weight:700;">New Contact Message</h1>
      <p style="margin:6px 0 0;color:#bbb;font-size:13px;">{{ config('app.name') }} Admin Notification</p>
    </td>
  </tr>

  <tr><td style="padding:32px;">

    {{-- ── Contact Information ── --}}
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Contact Information</h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <table width="100%" cellpadding="4" cellspacing="0">
          <tr>
            <td width="40%" style="color:#666;">Full Name</td>
            <td>{{ $contact->full_name }}</td>
          </tr>
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">Phone</td>
            <td>{{ $contact->phone }}</td>
          </tr>
          <tr>
            <td style="color:#666;">Subject</td>
            <td>{{ $contact->subject_label }}</td>
          </tr>
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">Submitted</td>
            <td>{{ $contact->created_at->format('F j, Y — g:i A') }}</td>
          </tr>
        </table>
      </td></tr>
    </table>

    {{-- ── Message ── --}}
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Message</h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <p style="margin:0;white-space:pre-line;line-height:1.6;">{{ $contact->message }}</p>
      </td></tr>
    </table>

  </td></tr>

  {{-- Footer --}}
  <tr>
    <td style="background:#f0f0f0;padding:16px 32px;text-align:center;font-size:12px;color:#888;border-top:1px solid #ddd;">
      This is an automated admin notification from {{ config('app.name') }}.
    </td>
  </tr>

</table>
</td></tr>
</table>

</body>
</html>
