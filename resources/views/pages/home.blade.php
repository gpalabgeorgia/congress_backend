@extends('layouts.app')
@section('content')
    <main>
        <!-- პრემიალური Hero-ბლოკი ვიდეო-ფოტო ყდით -->
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
        <!-- ვიზულაური ბარათების ბლოკი (მოღვაწეობის მიმართულებები) -->
        @if(isset($features) && $features->count())
            <section class="features">
                <div class="container">
                    <div class="features__grid">
                        @foreach($features as $feature)
                            <a href="{{ $feature->url }}" class="card {{ $feature->card_type }}">
                                <div class="card__background-flag"></div>

                                <div class="card__icon-box">
                                    @switch($feature->card_type)
                                        @case('card--culture')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M3 22h18M5 10v10M9 10v10M15 10v10M19 10v10M12 2L2 7v3h20V7L12 2z"/>
                                            </svg>
                                            @break

                                        @case('card--growth')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M18 20V10M12 20V4M6 20v-6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break

                                        @default
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <circle cx="12" cy="12" r="10"/>
                                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                                <path d="M2 12h20"/>
                                            </svg>
                                    @endswitch
                                </div>

                                <h3 class="card__title">
                                    {{ $feature->getTranslation('title') }}
                                </h3>

                                <p class="card__text">
                                    {{ $feature->getTranslation('text') }}
                                </p>

                                @if($actionText = $feature->getTranslation('action_text'))
                                    <div class="card__action">
                                        <span>{{ $actionText }}</span>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!-- ==========================================================================
       6. ვიდეო სექცია (VIDEO SECTION)
       ========================================================================== -->
        @if(isset($videoSection) && $videoSection->is_active)
            <section class="video-section">
                <!-- მარცხენა ტექსტური ბლოკი -->
                <div class="video-section__content">
                    <div class="video-section__bg-map"></div>
                    <div class="video-section__text-wrapper">
                        <h2 class="video-section__title">
                            {{ $videoSection->getTranslation('title') }}
                        </h2>
                        <p class="video-section__text">
                            {{ $videoSection->getTranslation('text') }}
                        </p>
                    </div>
                </div>

                <!-- მარჯვენა ნაწილი ვიდეოთი -->
                <div class="video-section__media">
                    @php
                        $videoPath = $videoSection->getTranslation('video_path');
                        $posterPath = $videoSection->poster_path;
                    @endphp

                    <video class="video-section__video" id="promo-video" playsinline
                           @if($posterPath) poster="{{ asset($posterPath) }}" @endif>
                        @if($videoPath)
                            <source src="{{ asset($videoPath) }}" type="video/mp4">
                        @endif
                        Your browser does not support the video tag.
                    </video>

                    <!-- ვიდეოს მართვის ღილაკი -->
                    <button class="video-control-btn" id="video-control-btn" aria-label="Play video">
                        <!-- აიქონი Play -->
                        <svg class="icon-play" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <!-- აიქონი Pause -->
                        <svg class="icon-pause" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                            <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                        </svg>
                        <!-- აიქონი Replay -->
                        <svg class="icon-replay" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                            <path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                        </svg>
                    </button>
                </div>
            </section>
        @endif
        <!-- ==========================================================================
       7. ღონისძიებების სლაიდერი (EVENTS SLIDER)
       ========================================================================== -->
        <section class="events-section">
            <div class="events-container">
                <!-- სექციის სათაური -->
                <h2 class="events-section-title">ჩვენი ღონისძიებები</h2>
                <div class="slider-wrapper">
                    <!-- მარცხენა ისარი -->
                    <button class="slider-arrow prev-arrow" id="slider-prev" aria-label="Предыдущий слайд">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </button>
                    <!-- სლაიდერის ფანჯარა -->
                    <div class="events-slider-track" id="events-slider-track">
                        <!-- ბარათი 1 -->
                        <div class="event-card">
                            <div class="event-card__image-wrapper">
                                <img src="images/events/event-1.jpg" alt="Event 1" class="event-card__image">
                            </div>
                            <h3 class="event-card__title">ბიზნეს ფორუმი თბილისში</h3>
                            <a href="#" class="event-card__link">დეტალურად →</a>
                        </div>
                        <!-- ბარათი 2 -->
                        <div class="event-card">
                            <div class="event-card__image-wrapper">
                                <img src="images/events/event-2.jpg" alt="Event 2" class="event-card__image">
                            </div>
                            <h3 class="event-card__title">კულტურული მემკვიდრეობის საღამო</h3>
                            <a href="#" class="event-card__link">დეტალურად →</a>
                        </div>
                        <!-- ბარათი 3 -->
                        <div class="event-card">
                            <div class="event-card__image-wrapper">
                                <img src="images/events/event-3.jpg" alt="Event 3" class="event-card__image">
                            </div>
                            <h3 class="event-card__title">საქველმოქმედო გალა ვახშამი</h3>
                            <a href="#" class="event-card__link">დეტალურად →</a>
                        </div>
                        <!-- ბარათი 4 -->
                        <div class="event-card">
                            <div class="event-card__image-wrapper">
                                <img src="images/events/event-4.jpg" alt="Event 4" class="event-card__image">
                            </div>
                            <h3 class="event-card__title">ახალგაზრდული კონგრესი 2026</h3>
                            <a href="#" class="event-card__link">დეტალურად →</a>
                        </div>
                        <!-- ბარათი 5 -->
                        <div class="event-card">
                            <div class="event-card__image-wrapper">
                                <img src="images/events/event-5.jpg" alt="Event 5" class="event-card__image">
                            </div>
                            <h3 class="event-card__title">საინვესტიციო პანელი</h3>
                            <a href="#" class="event-card__link">დეტალურად →</a>
                        </div>
                    </div>
                    <!-- მარჯვენა ისარი -->
                    <button class="slider-arrow next-arrow" id="slider-next" aria-label="Следующий слайд">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
        <!-- ==========================================================================
       8. სიახლეების გამოწერა (NEWSLETTER SECTION)
       ========================================================================== -->
        <section class="newsletter-section">
            <div class="newsletter-container">
                <!-- კონვერტის აიქონი -->
                <div class="newsletter-icon-wrapper">
                    <svg class="newsletter-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <!-- სათაურები ქართულად -->
                <h2 class="newsletter-title">გამოიწერეთ ჩვენი გვერდი ყველა სიახლის მისაღებად</h2>
                <p class="newsletter-subtitle">
                    გამოიწერეთ ჩვენი გვერდი. შეიყვანეთ თქვენი ელექტრონული ფოსტის მისამართი და მიიღეთ ყველა სიახლე ელექტრონულ ფოსტაზე
                </p>
                <!-- გამოწერის ფორმა -->
                <form class="newsletter-form" id="newsletter-form">
                    <div class="newsletter-input-group">
                        <input
                            type="email"
                            class="newsletter-input"
                            placeholder="ელექტრონული ფოსტის მისამართი"
                            required
                            aria-label="Email address"
                        >
                    </div>
                    <button type="submit" class="newsletter-btn">გამოწერა</button>
                </form>
            </div>
        </section>
    </main>
@endsection
