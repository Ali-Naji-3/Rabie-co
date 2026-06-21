@php
    $full  = (int) floor($rating);
    $half  = ($rating - $full) >= 0.5;
    $empty = 5 - $full - ($half ? 1 : 0);
@endphp
<div style="display:inline-block; line-height:1;">
    <div style="display:flex; align-items:center; gap:3px; white-space:nowrap;">
        <span style="display:inline-flex; align-items:center; gap:1px; font-size:13px;">
            @for($i = 0; $i < $full; $i++)
                <i class="fas fa-star" style="color:#f39c12;"></i>
            @endfor
            @if($half)
                <span style="position:relative; display:inline-block; width:1em; height:1em; vertical-align:middle;">
                    <i class="far fa-star" style="color:#ddd; position:absolute; top:0; left:0;"></i>
                    <i class="fas fa-star-half" style="color:#f39c12; position:absolute; top:0; left:0;"></i>
                </span>
            @endif
            @for($i = 0; $i < $empty; $i++)
                <i class="far fa-star" style="color:#ddd;"></i>
            @endfor
        </span>
        <span style="font-size:18px; font-weight:600; color:#556; line-height:1;">{{ number_format($rating, 1) }}</span>
    </div>
    @if(isset($count) && $count !== null)
        <div style="font-size:15px; color:#aaz; margin-top:2px; line-height:1; white-space:nowrap;">{{ number_format($count) }} Reviews</div>
    @endif
</div>
