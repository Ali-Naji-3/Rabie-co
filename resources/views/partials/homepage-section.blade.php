{{--
    Generic homepage section renderer.
    Receives: $section (HomepageSection with ->cards already eager-loaded)
    Dispatches each card to partials/cards/{card_layout}.blade.php
--}}
@if($section->cards->isNotEmpty())
<section class="reveal promo-banners-section{{ $section->css_class ? ' ' . $section->css_class : '' }}">
    <div class="promo-banner-section-header">
        <h6 class="promo-banner-section-title">{{ $section->title }}</h6>
        @if($section->subtitle)
            <p class="promo-banner-section-subtitle">{{ $section->subtitle }}</p>
        @endif
    </div>
    <div class="promo-banner-wrap">
        @if($section->card_layout === 'comparison_table')
            @include('partials.sections.comparison-table', ['section' => $section])
        @else
            <div class="promo-banner-carousel owl-carousel"
                 data-items="{{ min($section->cards->count(), 4) }}"
                 data-total="{{ $section->cards->count() }}">
                @foreach($section->cards as $card)
                    @include('partials.cards.' . $section->card_layout, ['card' => $card])
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif
