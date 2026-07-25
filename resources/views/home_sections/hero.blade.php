<section class="hero-premium" style="--hero-bg: url('{{ $heroBanner?->bg_image_url }}');">
    <div class="hero-premium__container">
        <!-- ტექსტური ბლოკი -->
        <div class="hero-content">
            @if($title = $heroBanner?->getTranslation('title'))
                <h1 class="hero-content__title">
                    {!! $title !!}
                </h1>
            @endif

            @if($subtitle = $heroBanner?->getTranslation('subtitle'))
                <p class="hero-content__subtitle">
                    {!! nl2br(e($subtitle)) !!}
                </p>
            @endif

            <!-- წითელი გამყოფი ხაზი -->
            <div class="hero-content__divider"></div>

            @if($desc = $heroBanner?->getTranslation('desc'))
                <p class="hero-content__desc">
                    {!! nl2br(e($desc)) !!}
                </p>
            @endif
        </div>

        <!-- დინამიური აიქონი ბმულების ბლოკი -->
        @if($heroBanner && count($heroBanner->formatted_features))
            <div class="hero-features">
                @foreach($heroBanner->formatted_features as $feature)
                    <a href="{{ $feature['url'] }}" class="hero-features__item">
                        <div class="hero-features__icon">
                            @if($feature['icon'])
                                <img src="{{ $feature['icon'] }}" alt="{{ $feature['label'] }}" class="hero-features__img">
                            @endif
                        </div>
                        <span class="hero-features__label">{{ $feature['label'] }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
