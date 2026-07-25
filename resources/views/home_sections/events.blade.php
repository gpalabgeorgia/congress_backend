<section class="events-section">
    <div class="events-container">
        <!-- სექციის სათაური -->
        <h2 class="events-section-title">
            {{ __('ჩვენი ღონისძიებები') }}
        </h2>

        <div class="slider-wrapper">
            <!-- მარცხენა ისარი -->
            <button class="slider-arrow prev-arrow" id="slider-prev" aria-label="წინა სლაიდი">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </button>

            <!-- სლაიდერის ფანჯარა -->
            <div class="events-slider-track" id="events-slider-track">
                @forelse($events as $event)
                    <div class="event-card">
                        <div class="event-card__image-wrapper">
                            <img src="{{ asset($event->image_path) }}" alt="{{ $event->getTranslation('title') }}" class="event-card__image">
                        </div>
                        <h3 class="event-card__title">
                            {{ $event->getTranslation('title') }}
                        </h3>
                        <a href="{{ $event->link_url ?? '#' }}" class="event-card__link">
                            {{ __('დეტალურად') }} →
                        </a>
                    </div>
                @empty
                @endforelse
            </div>

            <!-- მარჯვენა ისარი -->
            <button class="slider-arrow next-arrow" id="slider-next" aria-label="შემდეგი სლაიდი">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </div>
    </div>
</section>
