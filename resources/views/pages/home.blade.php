@extends('layouts.app')
@section('content')
    <main>
        @include('home_sections.hero')

        @include('home_sections.features')

        @include('home_sections.video')

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
