@if(!empty($description))
    @php
        $lines = array_values(array_filter(array_map('trim', explode("\n", $description))));
        $isMultiline = count($lines) > 1;
    @endphp
    @if($isMultiline)
        <ul style="list-style: none; padding: 0; margin: 0 0 6px 0;">
            @foreach(array_slice($lines, 0, 4) as $line)
                <li style="font-size: 13px; color: #555; font-weight: 500; padding: 1px 0; line-height: 1.5;">
                    <span style="color: #f39c12; margin-right: 5px;">•</span>{{ $line }}
                </li>
            @endforeach
        </ul>
    @else
        <p style="font-size: 13px; color: #555; font-weight: 500; margin-bottom: 6px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.5;">{{ $description }}</p>
    @endif
@endif
