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
