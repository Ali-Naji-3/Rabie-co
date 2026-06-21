<div class="prc-card">

    {{-- Top label: "2–4 WEEKS", "5–8 WEEKS", etc. --}}
    @if($banner->small_title)
        <div class="prc-top-label">{{ $banner->small_title }}</div>
    @endif

    {{-- Media area: image or video with optional overlay --}}
    <div class="prc-media">

        @if($banner->media_type === 'video')
            @if($banner->video_url)
                @php
                    $videoId   = '';
                    $videoType = '';
                    if (str_contains($banner->video_url, 'youtube.com') || str_contains($banner->video_url, 'youtu.be')) {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $banner->video_url, $m);
                        $videoId   = $m[1] ?? '';
                        $videoType = 'youtube';
                    } elseif (str_contains($banner->video_url, 'vimeo.com')) {
                        preg_match('/vimeo\.com\/(\d+)/', $banner->video_url, $m);
                        $videoId   = $m[1] ?? '';
                        $videoType = 'vimeo';
                    }
                @endphp
                @if($videoType === 'youtube' && $videoId)
                    <iframe class="prc-iframe"
                        src="https://www.youtube.com/embed/{{ $videoId }}?{{ $banner->autoplay ? 'autoplay=1&' : '' }}{{ $banner->loop ? 'loop=1&playlist=' . $videoId . '&' : '' }}{{ $banner->muted ? 'mute=1&' : '' }}{{ $banner->show_controls ? '' : 'controls=0&' }}rel=0&modestbranding=1"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                @elseif($videoType === 'vimeo' && $videoId)
                    <iframe class="prc-iframe"
                        src="https://player.vimeo.com/video/{{ $videoId }}?{{ $banner->autoplay ? 'autoplay=1&' : '' }}{{ $banner->loop ? 'loop=1&' : '' }}{{ $banner->muted ? 'muted=1&' : '' }}{{ $banner->show_controls ? '' : 'controls=0&' }}"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen></iframe>
                @endif
            @elseif($banner->video)
                <video class="prc-video"
                    {{ $banner->autoplay ? 'autoplay' : '' }}
                    {{ $banner->loop     ? 'loop'     : '' }}
                    {{ $banner->muted    ? 'muted'    : '' }}
                    {{ $banner->show_controls ? 'controls' : '' }}
                    @if($banner->video_thumbnail) poster="{{ asset('storage/' . $banner->video_thumbnail) }}" @endif
                    playsinline>
                    <source src="{{ asset('storage/' . $banner->video) }}" type="video/mp4">
                </video>
            @endif
        @else
            @if($banner->image)
                <picture>
                    @if($banner->mobile_image)
                        <source media="(max-width: 991px)" srcset="{{ asset('storage/' . $banner->mobile_image) }}">
                    @endif
                    <img src="{{ asset('storage/' . $banner->image) }}"
                         alt="{{ $banner->alt_text }}"
                         loading="lazy"
                         class="prc-img"
                         style="object-position: {{ $banner->focal_point ?? 'center top' }};">
                </picture>
            @endif
        @endif

        {{-- Overlay: gradient + title + description + button (all on the image) --}}
        @if($banner->main_title || $banner->description || $banner->button_text)
            <div class="prc-overlay" style="text-align: {{ $banner->text_alignment ?? 'left' }};">
                @if($banner->main_title)
                    <h3 class="prc-overlay-title" style="color: {{ $banner->text_color ?? '#ffffff' }};">{{ $banner->main_title }}</h3>
                @endif
                @if($banner->description)
                    <p class="prc-overlay-desc" style="color: {{ $banner->text_color ?? '#ffffff' }};">{{ $banner->description }}</p>
                @endif
                @if($banner->button_text && $banner->link_url)
                    <a class="prc-overlay-btn"
                       href="{{ $banner->link_url }}"
                       {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }}>{{ $banner->button_text }}</a>
                @endif
            </div>
        @endif

    </div>{{-- /.prc-media --}}

    {{-- Below-image: bottom title, description, and Shop Now link --}}
    @if($banner->bottom_title || $banner->bottom_description || $banner->link_url)
        <div class="prc-bottom">
            @if($banner->bottom_title)
                <h4 class="prc-bottom-title">{{ $banner->bottom_title }}</h4>
            @endif
            @if($banner->bottom_description)
                <p class="prc-bottom-desc">{{ $banner->bottom_description }}</p>
            @endif
            @if($banner->link_url)
                <a class="prc-shop-link"
                   href="{{ $banner->link_url }}"
                   {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }}>
                    Shop Now &rarr;
                </a>
            @endif
        </div>
    @endif

</div>{{-- /.prc-card --}}
