<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Order: {{ $order->order_number }}</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#333;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:24px 0;">
<tr><td align="center">
<table width="620" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:6px;overflow:hidden;border:1px solid #ddd;">

  {{-- Header --}}
  <tr>
    <td style="background:#111;padding:24px 32px;">
      <h1 style="margin:0;color:#fff;font-size:22px;font-weight:700;">New Order Received</h1>
      <p style="margin:6px 0 0;color:#bbb;font-size:13px;">{{ config('app.name') }} Admin Notification</p>
    </td>
  </tr>

  <tr><td style="padding:32px;">

    {{-- ── Order Information ── --}}
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;margin-bottom:12px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Order Information</h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <table width="100%" cellpadding="4" cellspacing="0">
          <tr>
            <td width="40%" style="color:#666;">Order Number</td>
            <td style="font-weight:700;">{{ $order->order_number }}</td>
          </tr>
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">Order Date</td>
            <td>{{ $order->created_at->format('F j, Y — g:i A') }}</td>
          </tr>
          <tr>
            <td style="color:#666;">Payment Method</td>
            <td>{{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</td>
          </tr>
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">Order Status</td>
            <td>{{ ucfirst($order->status) }}</td>
          </tr>
          <tr>
            <td style="color:#666;">Grand Total</td>
            <td style="font-weight:700;font-size:16px;color:#27ae60;">${{ number_format($order->total, 2) }}</td>
          </tr>
        </table>
      </td></tr>
    </table>

    {{-- ── Customer Information ── --}}
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Customer Information</h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <table width="100%" cellpadding="4" cellspacing="0">
          <tr>
            <td width="40%" style="color:#666;">Full Name</td>
            <td>{{ $shipping['name'] ?? 'N/A' }}</td>
          </tr>
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">Email</td>
            <td>{{ $order->customer_email }}</td>
          </tr>
          <tr>
            <td style="color:#666;">Phone</td>
            <td>{{ $shipping['phone'] ?? 'N/A' }}</td>
          </tr>
        </table>
      </td></tr>
    </table>

    {{-- ── Shipping Information ── --}}
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Shipping Address</h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <table width="100%" cellpadding="4" cellspacing="0">
          <tr>
            <td width="40%" style="color:#666;">Country</td>
            <td>{{ $shipping['country'] ?? 'N/A' }}</td>
          </tr>
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">City</td>
            <td>{{ $shipping['city'] ?? 'N/A' }}</td>
          </tr>
          @if(!empty($shipping['state']))
          <tr>
            <td style="color:#666;">State / Region</td>
            <td>{{ $shipping['state'] }}</td>
          </tr>
          @endif
          @if(!empty($shipping['postal_code']))
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">Postal Code</td>
            <td>{{ $shipping['postal_code'] }}</td>
          </tr>
          @endif
          <tr>
            <td style="color:#666;">Address</td>
            <td>
              {{ $shipping['address'] ?? '' }}
              @if(!empty($shipping['address_2']))
                <br>{{ $shipping['address_2'] }}
              @endif
            </td>
          </tr>
        </table>
      </td></tr>
    </table>

    {{-- ── Billing Information (only if different) ── --}}
    @if($billingDiffers)
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Billing Address <span style="color:#e74c3c;font-size:12px;">(different from shipping)</span></h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <table width="100%" cellpadding="4" cellspacing="0">
          <tr>
            <td width="40%" style="color:#666;">Country</td>
            <td>{{ $billing['country'] ?? 'N/A' }}</td>
          </tr>
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">City</td>
            <td>{{ $billing['city'] ?? 'N/A' }}</td>
          </tr>
          @if(!empty($billing['state']))
          <tr>
            <td style="color:#666;">State / Region</td>
            <td>{{ $billing['state'] }}</td>
          </tr>
          @endif
          @if(!empty($billing['postal_code']))
          <tr style="background:#f9f9f9;">
            <td style="color:#666;">Postal Code</td>
            <td>{{ $billing['postal_code'] }}</td>
          </tr>
          @endif
          <tr>
            <td style="color:#666;">Address</td>
            <td>{{ $billing['address'] ?? 'N/A' }}</td>
          </tr>
        </table>
      </td></tr>
    </table>
    @endif

    {{-- ── Products ── --}}
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Products Ordered</h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
          <thead>
            <tr style="background:#111;color:#fff;">
              <th align="left"  style="padding:10px 12px;font-weight:600;">Product</th>
              <th align="center" style="padding:10px 12px;font-weight:600;white-space:nowrap;">Qty</th>
              <th align="right"  style="padding:10px 12px;font-weight:600;white-space:nowrap;">Unit Price</th>
              <th align="right"  style="padding:10px 12px;font-weight:600;white-space:nowrap;">Line Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->items as $index => $item)
            <tr style="{{ $index % 2 === 0 ? 'background:#f9f9f9;' : '' }}">
              <td style="padding:10px 12px;border-bottom:1px solid #eee;">
                {{ $item->product->name ?? '(deleted product)' }}
              </td>
              <td align="center" style="padding:10px 12px;border-bottom:1px solid #eee;">{{ $item->quantity }}</td>
              <td align="right"  style="padding:10px 12px;border-bottom:1px solid #eee;">${{ number_format($item->price, 2) }}</td>
              <td align="right"  style="padding:10px 12px;border-bottom:1px solid #eee;font-weight:600;">${{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </td></tr>
    </table>

    {{-- ── Order Summary ── --}}
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td style="border-bottom:2px solid #111;padding-bottom:8px;">
          <h2 style="margin:0;font-size:15px;text-transform:uppercase;letter-spacing:1px;color:#111;">Order Summary</h2>
        </td>
      </tr>
      <tr><td style="padding-top:12px;">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right" style="padding:6px 0;color:#666;">Subtotal</td>
            <td align="right" width="120" style="padding:6px 0;">${{ number_format($order->subtotal, 2) }}</td>
          </tr>
          <tr>
            <td align="right" style="padding:6px 0;color:#666;">Shipping</td>
            <td align="right" style="padding:6px 0;">${{ number_format($order->shipping, 2) }}</td>
          </tr>
          <tr>
            <td align="right" style="padding:6px 0;color:#666;">Tax</td>
            <td align="right" style="padding:6px 0;">${{ number_format($order->tax, 2) }}</td>
          </tr>
          <tr style="border-top:2px solid #111;">
            <td align="right" style="padding:10px 0;font-weight:700;font-size:16px;">Grand Total</td>
            <td align="right" style="padding:10px 0;font-weight:700;font-size:16px;color:#27ae60;">${{ number_format($order->total, 2) }}</td>
          </tr>
        </table>
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
