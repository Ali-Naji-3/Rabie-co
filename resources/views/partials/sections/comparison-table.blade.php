@php
    $headers = $section->settings ?? [];
    // Sort headers if needed? Probably matches insertion order in KeyValue
@endphp

<div class="comparison-table-wrapper">
    <div class="container container-two">
        <div class="table-responsive">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th class="feature-header">FEATURES</th>
                        @foreach($headers as $key => $label)
                            <th class="competitor-header">{{ $label }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($section->cards as $row)
                        <tr>
                            <td class="feature-name">{{ $row->main_title }}</td>
                            @foreach($headers as $key => $label)
                                <td class="comparison-value">
                                    @php
                                        $val = strtolower($row->settings[$key] ?? '');
                                    @endphp
                                    @if($val === 'check' || $val === 'yes' || $val === 'tick' || $val === '1')
                                        <span class="icon-check"><i class="fas fa-check"></i></span>
                                    @elseif($val === 'x' || $val === 'no' || $val === 'cross' || $val === '0')
                                        <span class="icon-cross"><i class="fas fa-times"></i></span>
                                    @else
                                        {{ $row->settings[$key] ?? '-' }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.comparison-table-wrapper {
    background: #fff;
    padding: 60px 0;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.comparison-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.comparison-table th {
    background: #d19e66; /* Brand gold/beige header */
    color: #fff;
    padding: 20px 15px;
    text-align: center;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.comparison-table th.feature-header {
    text-align: left;
    padding-left: 30px;
    background: #c08d55;
    width: 250px;
}

.comparison-table td {
    padding: 18px 15px;
    text-align: center;
    border: 1px solid #f0f0f0;
    font-size: 14px;
    color: #333;
    background: #fff;
}

.comparison-table td.feature-name {
    text-align: left;
    padding-left: 30px;
    font-weight: 600;
    color: #1b1b18;
}

.comparison-table tr:nth-child(even) td {
    background: #fafafa;
}

.comparison-table tr:hover td {
    background: #fdfaf7;
}

.icon-check {
    color: #28a745;
    font-size: 18px;
}

.icon-cross {
    color: #dc3545;
    font-size: 18px;
}

@media (max-width: 991px) {
    .comparison-table th, .comparison-table td {
        padding: 12px 10px;
        font-size: 12px;
    }
    .comparison-table th.feature-header, .comparison-table td.feature-name {
        padding-left: 15px;
        width: 150px;
    }
}
</style>
