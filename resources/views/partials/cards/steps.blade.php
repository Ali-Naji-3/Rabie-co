<div class="step-card">

    @if($card->small_title)
        <div class="step-card-label">{{ $card->small_title }}</div>
    @endif

    @if($card->image)
        <div class="step-card-media">
            <picture>
                @if($card->mobile_image)
                    <source media="(max-width: 991px)" srcset="{{ asset('storage/' . $card->mobile_image) }}">
                @endif
                <img src="{{ asset('storage/' . $card->image) }}"
                     alt="{{ $card->alt_text }}"
                     loading="lazy"
                     class="step-card-img"
                     style="object-position: {{ $card->focal_point ?? 'center top' }};">
            </picture>
        </div>
    @endif

    <div class="step-card-body">
        @if($card->main_title)
            <h4 class="step-card-title">{{ $card->main_title }}</h4>
        @endif
        @if($card->description)
            <p class="step-card-desc">{{ $card->description }}</p>
        @endif
        @if($card->bottom_description)
            <p class="step-card-desc">{{ $card->bottom_description }}</p>
        @endif
    </div>

</div>
